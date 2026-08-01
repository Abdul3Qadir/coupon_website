<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryPageController extends Controller
{
    public function index(): View
    {
        return view('categories', [
            'categories' => Category::withCount('offers')->orderByDesc('offers_count')->get(),
        ]);
    }

    public function byCategory(Category $category): View
    {
        return view('coupons-category', [
            'category' => $category,
        ]);
    }
}