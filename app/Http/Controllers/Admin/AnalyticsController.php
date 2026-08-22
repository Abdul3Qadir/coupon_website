<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AnalyticsService;

class AnalyticsController extends Controller
{
    public function __construct(private AnalyticsService $analytics) {}

    public function index()
    {
        $brandsStats = $this->analytics->getSuperAdminBrandsStats();
        $offersStats = $this->analytics->getSuperAdminOffersStats();
        $blogsStats = $this->analytics->getSuperAdminBlogsStats();
        $topBrands = $this->analytics->getSuperAdminTopBrands(15);
        $topOffers = $this->analytics->getSuperAdminTopOffers(10);
        $topBlogs = $this->analytics->getSuperAdminTopBlogs(10);
        $offersTrend = $this->analytics->getSuperAdminOffersTrend(30);
        $blogsTrend = $this->analytics->getSuperAdminBlogsTrend(30);
        $offersByCategory = $this->analytics->getSuperAdminOffersByCategory();
        $pendingActions = $this->analytics->getSuperAdminPendingActions();

        return view('admin.analytics.index', [
            'brandsStats' => $brandsStats,
            'offersStats' => $offersStats,
            'blogsStats' => $blogsStats,
            'topBrands' => $topBrands,
            'topOffers' => $topOffers,
            'topBlogs' => $topBlogs,
            'offersTrend' => $offersTrend,
            'blogsTrend' => $blogsTrend,
            'offersByCategory' => $offersByCategory,
            'pendingActions' => $pendingActions,
        ]);
    }
}