<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class BrandVerifiedNotification extends Notification
{
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Brand Verified',
            'message' => 'Your brand has been verified. Your dashboard is now unlocked.',
            'action_url' => route('brand.dashboard'),
        ];
    }
}