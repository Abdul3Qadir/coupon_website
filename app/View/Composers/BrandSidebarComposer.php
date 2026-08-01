<?php

namespace App\View\Composers;

use App\Enums\OfferStatus;
use Illuminate\View\View;

class BrandSidebarComposer
{
    public function compose(View $view): void
    {
        $brand = auth('brand')->user();

        if (!$brand) {
            return;
        }

        $view->with([
            'pendingOffersCount' => $brand->offers()->where('status', OfferStatus::Pending)->count(),
            'unreadNotificationsCount' => $brand->unreadNotifications()->count(),
        ]);
    }
}
