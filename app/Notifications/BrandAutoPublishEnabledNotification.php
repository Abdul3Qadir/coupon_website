<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class BrandAutoPublishEnabledNotification extends Notification
{
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Auto-Publish Enabled',
            'message' => 'Your offers will now be published automatically without review.',
            'action_url' => route('brand.offers.index'),
        ];
    }
}