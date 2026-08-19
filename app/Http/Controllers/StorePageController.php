<?php

namespace App\Http\Controllers;

use App\Enums\BrandStatus;
use App\Models\Brand;
use Illuminate\View\View;

class StorePageController extends Controller
{
    public function show(Brand $brand): View
    {
        abort_unless($brand->status === BrandStatus::Verified, 404);

        $brand->load('category');

        $coupons = $brand->offers()->approved()->active()->coupons()->latest()->get();
        $deals = $brand->offers()->approved()->active()->deals()->latest()->get();

        $shownOfferIds = $coupons->merge($deals)->pluck('id');
        if ($shownOfferIds->isNotEmpty()) {
            \App\Models\Offer::whereIn('id', $shownOfferIds)->increment('views_count');
        }

        $expiredCoupons = $brand->offers()
            ->where('type', 'coupon')
            ->approved()
            ->where('expires_at', '<', now())
            ->get();

        $expiredDeals = $brand->offers()
            ->where('type', 'deal')
            ->approved()
            ->where('expires_at', '<', now())
            ->get();

        $relatedStores = \App\Models\Brand::where('category_id', $brand->category_id)
            ->where('id', '!=', $brand->id)
            ->withCount('offers')
            ->limit(8)
            ->get();

        $similarStores = Brand::where('category_id', $brand->category_id)
            ->where('id', '!=', $brand->id)
            ->where('status', BrandStatus::Verified)
            ->withCount('offers')
            ->take(4)
            ->get();

        return view('stores.show', [
            'brand' => $brand,
            'coupons' => $coupons,
            'deals' => $deals,
            'similarStores' => $similarStores,
            'bestDiscount' => $coupons->merge($deals)->max('discount_value'),
            'expiredCoupons' => $expiredCoupons,
            'expiredDeals' => $expiredDeals,
            'relatedStores' => $relatedStores
        ]);
    }
}