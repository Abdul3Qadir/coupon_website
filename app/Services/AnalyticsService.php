<?php

namespace App\Services;

use App\Models\Offer;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Admin;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Enums\OfferType;

class AnalyticsService
{
    public function getBrandOffersStats(Brand $brand): array
    {
        $allOffers = $brand->offers();
        
        $totalViews = $allOffers->sum('views_count') ?? 0;
        $totalClicks = $allOffers->sum('clicks_count') ?? 0;
        $ctr = $totalViews > 0 ? ($totalClicks / $totalViews) * 100 : 0;
        
        $monthlyViews = $allOffers->clone()->where('created_at', '>=', now()->subDays(30))
            ->sum('views_count') ?? 0;
        $monthlyClicks = $allOffers->clone()->where('created_at', '>=', now()->subDays(30))
            ->sum('clicks_count') ?? 0;
        
        return [
            'totalOffers' => $allOffers->count(),
            'activeOffers' => $allOffers->clone()->where('status', 'approved')->count(),
            'pendingOffers' => $allOffers->clone()->where('status', 'pending')->count(),
            'rejectedOffers' => $allOffers->clone()->where('status', 'rejected')->count(),
            'totalViews' => $totalViews,
            'totalClicks' => $totalClicks,
            'ctr' => round($ctr, 2),
            'monthlyViews' => $monthlyViews,
            'monthlyClicks' => $monthlyClicks,
            'coupons' => $allOffers->clone()->coupons()->count(),
            'deals' => $allOffers->clone()->deals()->count(),
        ];
    }

    public function getBrandOffersTrend(Brand $brand, int $days = 30): Collection
    {
        $data = $brand->offers()
            ->where('created_at', '>=', now()->subDays($days))
            ->selectRaw('DATE(created_at) as date, SUM(views_count) as views, SUM(clicks_count) as clicks')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        if ($data->isEmpty()) {
            for ($i = $days; $i >= 0; $i--) {
                $data->push((object)[
                    'date' => now()->subDays($i)->format('Y-m-d'),
                    'views' => 0,
                    'clicks' => 0,
                ]);
            }
        }

        return $data->map(fn($item) => [
            'date' => $item->date,
            'views' => $item->views ?? 0,
            'clicks' => $item->clicks ?? 0,
        ]);
    }

    public function getBrandTopOffers(Brand $brand, int $limit = 10): Collection
    {
        return $brand->offers()
            ->with('category', 'brand')
            ->select('id', 'title', 'type', 'views_count', 'clicks_count', 'status', 'created_at', 'category_id', 'brand_id')
            ->orderByDesc('clicks_count')
            ->limit($limit)
            ->get()
            ->map(fn($offer) => [
                'id' => $offer->id,
                'title' => $offer->title,
                'type' => $offer->type,
                'views' => $offer->views_count,
                'clicks' => $offer->clicks_count,
                'ctr' => $offer->views_count > 0 ? round(($offer->clicks_count / $offer->views_count) * 100, 2) : 0,
                'status' => $offer->status->value ?? 'pending',
                'category' => $offer->category?->name,
                'createdAt' => $offer->created_at->format('M d'),
            ]);
    }

    public function getSuperAdminBrandsStats(): array
    {
        $allBrands = Brand::query();
        
        return [
            'totalBrands' => $allBrands->count(),
            'verifiedBrands' => $allBrands->where('status', 'verified')->count(),
            'pendingBrands' => $allBrands->where('status', 'pending')->count(),
            'rejectedBrands' => $allBrands->where('status', 'rejected')->count(),
            'suspendedBrands' => $allBrands->where('status', 'suspended')->count(),
        ];
    }

    public function getSuperAdminOffersStats(): array
    {
        $allOffers = Offer::query();
        $activeOffers = $allOffers->clone()->approved()->active();
        
        $totalViews = $allOffers->clone()->sum('views_count');
        $totalClicks = $allOffers->clone()->sum('clicks_count');
        $ctr = $totalViews > 0 ? ($totalClicks / $totalViews) * 100 : 0;
        
        return [
            'totalOffers' => $allOffers->count(),
            'activeOffers' => $activeOffers->count(),
            'pendingOffers' => $allOffers->clone()->where('status', 'pending')->count(),
            'rejectedOffers' => $allOffers->clone()->where('status', 'rejected')->count(),
            'totalViews' => $totalViews,
            'totalClicks' => $totalClicks,
            'ctr' => round($ctr, 2),
            'coupons' => $allOffers->clone()->where('type', 'coupon')->count(),
            'deals' => $allOffers->clone()->where('type', 'deal')->count(),
        ];
    }

    public function getSuperAdminBlogsStats(): array
    {
        $allBlogs = Blog::query();
        
        $totalViews = $allBlogs->sum('views_count');
        $avgViews = $allBlogs->count() > 0 
            ? round($totalViews / $allBlogs->count(), 2)
            : 0;
        
        return [
            'totalPosts' => $allBlogs->count(),
            'publishedPosts' => $allBlogs->where('status', 'published')->count(),
            'draftPosts' => $allBlogs->where('status', 'draft')->count(),
            'totalViews' => $totalViews,
            'avgViews' => $avgViews,
        ];
    }

    public function getSuperAdminTopBrands(int $limit = 15): Collection
{
    return Brand::select('id', 'name', 'small_logo', 'category_id', 'status', 'verified_at')
        ->withCount(['offers' => function($q) {
            $q->where('status', 'approved');
        }])
        ->withSum(['offers' => function($q) {
            $q->where('status', 'approved');
        }], 'views_count')
        ->withSum(['offers' => function($q) {
            $q->where('status', 'approved');
        }], 'clicks_count')
        ->orderByDesc('offers_count')
        ->limit($limit)
        ->get()
        ->map(fn($brand) => [
            'id' => $brand->id,
            'name' => $brand->name,
            'logo' => $brand->small_logo,
            'offers' => $brand->offers_count ?? 0,
            'views' => $brand->offers_sum_views_count ?? 0,
            'clicks' => $brand->offers_sum_clicks_count ?? 0,
            'ctr' => ($brand->offers_sum_views_count ?? 0) > 0 
                ? round(($brand->offers_sum_clicks_count ?? 0) / ($brand->offers_sum_views_count ?? 0) * 100, 2)
                : 0,
            'status' => $brand->status,
        ]);
}

    public function getSuperAdminTopOffers(int $limit = 10): Collection
    {
        return Offer::approved()
            ->with('brand', 'category')
            ->select('id', 'title', 'type', 'views_count', 'clicks_count', 'brand_id', 'category_id', 'created_at')
            ->orderByDesc('clicks_count')
            ->limit($limit)
            ->get()
            ->map(fn($offer) => [
                'id' => $offer->id,
                'title' => $offer->title,
                'brand' => $offer->brand?->name,
                'type' => $offer->type,
                'views' => $offer->views_count,
                'clicks' => $offer->clicks_count,
                'ctr' => $offer->views_count > 0 ? round(($offer->clicks_count / $offer->views_count) * 100, 2) : 0,
            ]);
    }

    public function getSuperAdminTopBlogs(int $limit = 10): Collection
    {
        return Blog::where('status', 'published')
            ->with('admin', 'blogCategory')
            ->select('id', 'title', 'views_count', 'admin_id', 'blog_category_id', 'published_at')
            ->orderByDesc('views_count')
            ->limit($limit)
            ->get()
            ->map(fn($blog) => [
                'id' => $blog->id,
                'title' => $blog->title,
                'author' => $blog->admin?->name,
                'views' => $blog->views_count,
                'category' => $blog->blogCategory?->name,
                'publishedAt' => $blog->published_at?->format('M d, Y'),
            ]);
    }

    public function getSuperAdminOffersTrend(int $days = 30): Collection
    {
        return Offer::where('created_at', '>=', now()->subDays($days))
            ->selectRaw('DATE(created_at) as date, SUM(views_count) as views, SUM(clicks_count) as clicks')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get()
            ->map(fn($item) => [
                'date' => $item->date,
                'views' => $item->views ?? 0,
                'clicks' => $item->clicks ?? 0,
            ]);
    }

    public function getSuperAdminBlogsTrend(int $days = 30): Collection
    {
        return Blog::where('created_at', '>=', now()->subDays($days))
            ->selectRaw('DATE(created_at) as date, SUM(views_count) as views')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get()
            ->map(fn($item) => [
                'date' => $item->date,
                'views' => $item->views ?? 0,
            ]);
    }

    public function getSuperAdminOffersByCategory(): Collection
    {
        return Offer::approved()
            ->active()
            ->join('categories', 'offers.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, COUNT(*) as total, SUM(offers.views_count) as views, SUM(offers.clicks_count) as clicks')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total')
            ->get()
            ->map(fn($item) => [
                'category' => $item->name,
                'offers' => $item->total,
                'views' => $item->views,
                'clicks' => $item->clicks,
            ]);
    }

    public function getSuperAdminPendingActions(): array
    {
        return [
            'pendingBrands' => Brand::where('status', 'pending')->count(),
            'pendingBrandsUrgent' => Brand::where('status', 'pending')
                ->where('created_at', '<', now()->subHours(48))
                ->count(),
            'pendingOffers' => Offer::where('status', 'pending')->count(),
            'pendingOffersUrgent' => Offer::where('status', 'pending')
                ->where('created_at', '<', now()->subDays(3))
                ->count(),
            'pendingAdmins' => Admin::where('status', 'pending')
                ->where('role', 'sub_admin')
                ->count(),
            'pendingAdminsUrgent' => Admin::where('status', 'pending')
                ->where('role', 'sub_admin')
                ->where('created_at', '<', now()->subDays(2))
                ->count(),
        ];
    }
}