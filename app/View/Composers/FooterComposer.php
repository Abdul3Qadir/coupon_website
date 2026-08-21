<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class FooterComposer
{
    public function compose(View $view): void
    {
        $footerCategories = Category::withCount(['offers' => function ($query) {
            $query->where('status', 'approved');
        }])
            ->orderByDesc('offers_count')
            ->limit(8)
            ->get();

        $view->with('footerCategories', $footerCategories);
    }
}