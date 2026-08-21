<?php

namespace App\Http\Controllers\Brand;

use App\Enums\OfferStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $brand = $request->user('brand');

        return view('brand.dashboard', [
            'totalOffers' => $brand->offers()->count(),
            'liveOffers' => $brand->offers()->where('status', OfferStatus::Approved)->count(),
            'pendingOffers' => $brand->offers()->where('status', OfferStatus::Pending)->count(),
            'totalViews' => $brand->views_count,
            'recentOffers' => $brand->offers()->latest()->take(5)->get(),
        ]);
    }
}
