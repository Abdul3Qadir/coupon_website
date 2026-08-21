<?php
namespace App\Http\Controllers;

use App\Enums\DiscountType;
use App\Models\Offer;
use App\Models\Category;
use Illuminate\View\View;

class DealPageController extends Controller
{
    public function index(): View
    {
        $tab = request('tab', 'active'); // active | expired
        $sort = request('sort', 'trending'); // trending | newest | ending | discount
        $searchQuery = request('search');
        $selectedCategory = request('category');

        // Base query
        $query = Offer::deals()
            ->approved()
            ->with(['brand', 'category']);

        // Tab filter
        if ($tab === 'expired') {
            $query->expired();
        } else {
            $query->active();
        }

        // Search filter
        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%{$searchQuery}%")
                  ->orWhere('description', 'like', "%{$searchQuery}%")
                  ->orWhereHas('brand', function ($bq) use ($searchQuery) {
                      $bq->where('name', 'like', "%{$searchQuery}%");
                  });
            });
        }

        if ($selectedCategory) {
            $query->whereHas('category', function ($cq) use ($selectedCategory) {
                $cq->where('slug', $selectedCategory);
            });
        }

        switch ($sort) {
            case 'newest':
                $query->orderByDesc('created_at');
                break;
            case 'ending':
                $query->whereNotNull('expires_at')
                      ->orderBy('expires_at', 'asc');
                break;
            case 'discount':
                $query->where('discount_type', DiscountType::Percentage)
                      ->orderByDesc('discount_value');
                break;
            default: // trending
                $query->orderByDesc('clicks_count');
                break;
        }

        $deals = $query->paginate(9)->withQueryString();

        $trendingDeals = collect();
        if ($tab === 'active' && !$searchQuery && !$selectedCategory && $deals->currentPage() === 1) {
            $trendingDeals = Offer::deals()
                ->approved()
                ->active()
                ->with(['brand', 'category'])
                ->orderByDesc('clicks_count')
                ->limit(3)
                ->get();
        }

        // Stats
        $totalActiveDeals = Offer::deals()->approved()->active()->count();
        $totalExpiredDeals = Offer::deals()->approved()->expired()->count();
        $endingToday = Offer::deals()
            ->approved()
            ->active()
            ->whereDate('expires_at', now()->toDateString())
            ->count();

        $categories = Category::query()
            ->withCount(['offers' => function ($q) {
                $q->deals()->approved()->active();
            }])
            ->orderBy('name')
            ->get();

        return view('deals', compact(
            'deals',
            'trendingDeals',
            'categories',
            'totalActiveDeals',
            'totalExpiredDeals',
            'endingToday',
            'tab',
            'sort',
            'searchQuery',
            'selectedCategory'
        ));
    }
}