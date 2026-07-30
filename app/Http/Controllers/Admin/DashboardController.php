<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BrandStatus;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Offer;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalBrands' => Brand::count(),
            'liveOffersCount' => Offer::approved()->count(),
            'totalBlogs' => Blog::count(),
            'pendingBrandsCount' => Brand::where('status', BrandStatus::Pending)->count(),
            'pendingOffersCount' => Offer::pending()->count(),
            'pendingBrands' => Brand::where('status', BrandStatus::Pending)->latest()->take(5)->get(),
            'recentOffers' => Offer::with('brand')->latest()->take(5)->get(),
            'offersLast7Days' => $this->offersLast7Days(),
        ]);
    }

    private function offersLast7Days(): array
    {
        $counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);

            $counts[$date->format('D')] = Offer::whereDate('created_at', $date->toDateString())->count();
        }

        return $counts;
    }
}