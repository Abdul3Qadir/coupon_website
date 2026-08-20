<?php

namespace App\Http\Controllers;

use App\Enums\BrandStatus;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\Http\Request;

class StoreListingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $letter = $request->query('letter', 'all');
        $categorySlug = $request->query('category', 'all');
        $tab = $request->query('tab', 'all');

        $query = Brand::where('status', BrandStatus::Verified)
            ->withCount('offers');


        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $activeCategory = null;

        if ($categorySlug !== 'all') {
            $activeCategory = Category::where('slug', $categorySlug)->first();

            if ($activeCategory) {
                $query->where('category_id', $activeCategory->id);
            }
        }


        match ($tab) {
            'trending' => $query->where('is_featured', true),
            'new' => $query->where('created_at', '>=', now()->subDays(30)),
            'popular' => $query->orderByDesc('offers_count'),
            default => null,
        };


        $lettersQuery = clone $query;

        $activeLetters = $lettersQuery
            ->get(['name'])
            ->map(function ($brand) {
                $firstLetter = strtoupper(
                    mb_substr(trim($brand->name), 0, 1)
                );

                return preg_match('/^[A-Z]$/', $firstLetter)
                    ? $firstLetter
                    : '#';
            })
            ->unique()
            ->sort()
            ->values()
            ->toArray();


        if ($letter !== 'all') {
            if ($letter === '#') {
                $query->whereRaw("
                    UPPER(LEFT(TRIM(name), 1)) NOT BETWEEN 'A' AND 'Z'
                ");
            } else {
                $query->where('name', 'LIKE', $letter . '%');
            }
        }


        if ($tab !== 'popular') {
            $query->orderBy('name');
        }

        $stores = $query->paginate(20)->withQueryString();


        if ($request->ajax()) {
            return response()->json([
                'html' => view('stores._cards', compact('stores'))->render(),
                'nextPageUrl' => $stores->nextPageUrl(),
            ]);
        }

        return view('stores.index', [
            'stores' => $stores,
            'categories' => Category::orderBy('name')->get(),
            'activeLetters' => $activeLetters,
            'search' => $search,
            'activeLetter' => $letter,
            'activeCategorySlug' => $categorySlug,
            'activeTab' => $tab,
            'totalStores' => Brand::where('status', BrandStatus::Verified)->count(),
            'totalCoupons' => Offer::approved()->where(function ($query) {
                    $query->whereNull('expires_at')
                ->orWhere('expires_at', '>=', now());
                    })
                ->count(),
        ]);
    }
}