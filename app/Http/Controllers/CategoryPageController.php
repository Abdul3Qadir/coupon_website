<?php

namespace App\Http\Controllers;

use App\Enums\BrandStatus;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\View\View;

class CategoryPageController extends Controller
{
    public function index(): View
    {
        return view('categories', [
            'categories' => Category::withCount(['brands', 'offers'])->orderByDesc('offers_count')->get(),
            'totalStores' => Brand::where('status', BrandStatus::Verified)->count(),
            'totalCoupons' => Offer::approved()->count(),
        ]);
    }

    public function byCategory(Category $category): View
    {
        $stores = Brand::where('category_id', $category->id)
            ->where('status', BrandStatus::Verified)
            ->withCount('offers')
            ->orderByDesc('offers_count')
            ->paginate(12);

        return view('coupons-category', [
            'category' => $category,
            'stores' => $stores,
        ]);
    }
}