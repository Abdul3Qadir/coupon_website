<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Services\AnalyticsService;

class AnalyticsController extends Controller
{
    public function __construct(private AnalyticsService $analytics) {}

    public function index()
    {
        $brand = auth('brand')->user();

        $offersStats = $this->analytics->getBrandOffersStats($brand);
        $offersTrend = $this->analytics->getBrandOffersTrend($brand, 30);
        $topOffers = $this->analytics->getBrandTopOffers($brand, 10);

        return view('brand.analytics.index', [
            'offersStats' => $offersStats,
            'offersTrend' => $offersTrend,
            'topOffers' => $topOffers,
        ]);
    }
}