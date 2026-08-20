<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Category;
use Illuminate\View\View;

class DealPageController extends Controller
{
    public function index(): View
    {
        $activeDeals = Offer::deals()
            ->approved()
            ->active()
            ->with('brand', 'category')
            ->orderByDesc('is_trending')
            ->orderBy('expires_at', 'asc')
            ->paginate(6, ['*'], 'page', 1);

        $expiredDeals = Offer::deals()
            ->approved()
            ->where(function ($query) {
                $query->whereNotNull('expires_at')
                    ->where('expires_at', '<=', now());
            })
            ->with('brand', 'category')
            ->orderBy('expires_at', 'desc')
            ->limit(3)
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

        $totalCategories = Category::where('is_active', true)->count();

        return view('deals', [
            'activeDeals' => $activeDeals,
            'expiredDeals' => $expiredDeals,
            'totalActiveDeals' => $totalActiveDeals,
            'endingToday' => $endingToday,
            'totalCategories' => $totalCategories,
        ]);
    }
}