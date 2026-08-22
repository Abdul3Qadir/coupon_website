<?php

namespace App\Http\Controllers;

use App\Enums\BrandStatus;
use App\Enums\BlogStatus;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Blog;
use Illuminate\View\View;

class HomePageController extends Controller
{
    public function index(): View
    {
        $carouselBrands = Brand::where('status', BrandStatus::Verified)
            ->whereNotNull('small_logo')
            ->orderBy('name')
            ->get();

        $topCoupons = Offer::with('brand')
            ->approved()
            ->active()
            ->coupons()
            ->latest()
            ->limit(6)
            ->get();

        if ($topCoupons->isNotEmpty()) {
            Offer::whereIn('id', $topCoupons->pluck('id'))->increment('views_count');
        }

        $featuredStores = Brand::where('status', BrandStatus::Verified)
            ->where('is_featured', true)
            ->withCount(['offers' => function ($query) {
                $query->approved()->active();
            }])
            ->orderBy('name')
            ->limit(10)
            ->get();

        $trendingStoreIds = Offer::approved()
            ->active()
            ->where('is_trending', true)
            ->distinct()
            ->pluck('brand_id');

        $trendingStores = Brand::where('status', BrandStatus::Verified)
            ->withCount('offers')
            ->orderByDesc('total_views')
            ->limit(10)
            ->get();

        $popularStores = Brand::where('status', BrandStatus::Verified)
            ->withCount('offers')
            ->orderByDesc('offers_count')
            ->limit(10)
            ->get();

        $newStores = Brand::where('status', BrandStatus::Verified)
            ->withCount(['offers' => function ($query) {
                $query->approved()->active();
            }])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $topDeals = Offer::with('brand')
            ->approved()
            ->active()
            ->deals()
            ->latest()
            ->limit(6)
            ->get();

        if ($topDeals->isNotEmpty()) {
            Offer::whereIn('id', $topDeals->pluck('id'))->increment('views_count');
        }

        $categories = Category::withCount(['offers' => function ($query) {
            $query->approved()->active();
        }])
            ->orderByDesc('offers_count')
            ->get();

        $latestArticles = Blog::published()
            ->latest()
            ->limit(3)
            ->get();

        $trendingTags = Brand::where('status', BrandStatus::Verified)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        $totalStores = Brand::where('status', BrandStatus::Verified)->count();

        return view('home', compact(
            'carouselBrands',
            'topCoupons',
            'featuredStores',
            'trendingStores',
            'popularStores',
            'newStores',
            'topDeals',
            'categories',
            'latestArticles',
            'trendingTags',
            'totalStores'
        ));
    }
}