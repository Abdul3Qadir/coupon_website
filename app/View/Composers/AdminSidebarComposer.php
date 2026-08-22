<?php

namespace App\View\Composers;

use App\Enums\AdminStatus;
use App\Enums\BrandStatus;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Offer;
use App\Models\AdminMessage;
use Illuminate\View\View;

class AdminSidebarComposer
{
    public function compose(View $view): void
    {
        $admin = auth('admin')->user();

        if (!$admin) {
            return;
        }

        $isSuperAdmin = $admin->isSuperAdmin();

        $pendingOffersQuery = Offer::pending();
        if (!$isSuperAdmin) {
            $pendingOffersQuery->where('created_by_admin_id', $admin->id);
        }

        // Recent chat messages for dropdown
        $recentMessages = AdminMessage::where(function ($query) use ($admin) {
            $query->where('sender_admin_id', $admin->id)
                ->orWhere('receiver_admin_id', $admin->id);
        })
        ->with(['sender', 'receiver'])
        ->latest()
        ->take(6)
        ->get();

        $view->with([
            'pendingBrandsCount' => $isSuperAdmin ? Brand::where('status', BrandStatus::Pending)->count() : null,
            'pendingSubAdminsCount' => $isSuperAdmin ? Admin::where('status', AdminStatus::Pending)->count() : null,
            'pendingOffersCount' => $pendingOffersQuery->count(),
            'unreadMessagesCount' => $admin->receivedMessages()->whereNull('read_at')->count(),
            'unreadNotificationsCount' => $admin->unreadNotifications()->count(),
            'recentNotifications' => $admin->notifications()->latest()->take(6)->get(),
            'recentMessages' => $recentMessages,
        ]);
    }
}