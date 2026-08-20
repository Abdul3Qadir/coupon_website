<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Category;
use Illuminate\View\View;

class DealPageController extends Controller
{
    public function index(): View
    {
        $searchQuery = request('search');
        $selectedCategory = request('category');

        $trendingDeals = Offer::deals()
            ->approved()
            ->active()
            ->with('brand', 'category')
            ->orderByDesc('clicks_count')
            ->limit(3)
            ->get();

        $activeDeals = Offer::deals()
            ->approved()
            ->active()
            ->with('brand', 'category')
            ->when($searchQuery, function ($query) use ($searchQuery) {
                $query->where('title', 'like', "%{$searchQuery}%")
                    ->orWhere('description', 'like', "%{$searchQuery}%")
                    ->orWhereHas('brand', function ($q) use ($searchQuery) {
                        $q->where('name', 'like', "%{$searchQuery}%");
                    });
            })
            ->when($selectedCategory, function ($query) use ($selectedCategory) {
                $query->whereHas('category', function ($q) use ($selectedCategory) {
                    $q->where('slug', $selectedCategory);
                });
            })
            ->orderByDesc('clicks_count')
            ->paginate(6);

        $expiredDeals = Offer::deals()
            ->approved()
            ->where(function ($query) {
                $query->whereNotNull('expires_at')
                    ->where('expires_at', '<=', now());
            })
            ->with('brand', 'category')
            ->orderBy('expires_at', 'desc')
            ->limit(6)
            ->get();

        $totalActiveDeals = Offer::deals()
            ->approved()
            ->active()
            ->count();

        $endingToday = Offer::deals()
            ->approved()
            ->active()
            ->whereDate('expires_at', now())
            ->count();

        $categories = Category::where('is_active', true)
            ->withCount(['offers' => function ($query) {
                $query->active()->approved();
            }])
            ->orderBy('name', 'asc')
            ->get();

        return view('deals', [
            'trendingDeals' => $trendingDeals,
            'activeDeals' => $activeDeals,
            'expiredDeals' => $expiredDeals,
            'categories' => $categories,
            'totalActiveDeals' => $totalActiveDeals,
            'endingToday' => $endingToday,
            'totalCategories' => $categories->count(),
            'searchQuery' => $searchQuery,
            'selectedCategory' => $selectedCategory,
        ]);
    }
}