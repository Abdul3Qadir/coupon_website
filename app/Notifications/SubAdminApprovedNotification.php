<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class SubAdminApprovedNotification extends Notification
{
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Access Approved',
            'message' => 'Your Sub-Admin access has been approved.',
            'action_url' => route('admin.dashboard'),
        ];
    }
}