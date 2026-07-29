<?php

namespace App\View\Composers;

use App\Enums\AdminStatus;
use App\Enums\BrandStatus;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Offer;
use Illuminate\View\View;

class AdminSidebarComposer
{
    public function compose(View $view): void
    {
        $admin = auth('admin')->user();

        if (!$admin) {
            return;
        }

        $view->with([
            'pendingBrandsCount' => Brand::where('status', BrandStatus::Pending)->count(),
            'pendingSubAdminsCount' => Admin::where('status', AdminStatus::Pending)->count(),
            'pendingOffersCount' => Offer::pending()->count(),
            'unreadMessagesCount' => $admin->receivedMessages()->whereNull('read_at')->count(),
            'unreadNotificationsCount' => $admin->unreadNotifications()->count(),
        ]);
    }
}