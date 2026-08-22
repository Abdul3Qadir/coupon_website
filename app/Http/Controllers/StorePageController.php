<?php

namespace App\Http\Controllers;

use App\Enums\BrandStatus;
use App\Enums\DiscountType;
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

        if ($coupons->isNotEmpty()) {
            Offer::whereIn('id', $coupons->pluck('id'))->increment('views_count');
        }

        $deals = $brand->offers()->approved()->active()->deals()->latest()->get();
        if ($deals->isNotEmpty()) {
            Offer::whereIn('id', $deals->pluck('id'))->increment('views_count');
        }

        $brand->increment('views_count');

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

        $allActiveOffers = $coupons->merge($deals);
        $bestDiscount = $allActiveOffers
            ->where('discount_type', DiscountType::Percentage)
            ->max('discount_value');

        return view('stores.show', [
            'brand' => $brand,
            'coupons' => $coupons,
            'deals' => $deals,
            'similarStores' => $similarStores,
            'bestDiscount' => $bestDiscount,
            'expiredCoupons' => $expiredCoupons,
            'expiredDeals' => $expiredDeals,
            'relatedStores' => $relatedStores
        ]);
    }
}