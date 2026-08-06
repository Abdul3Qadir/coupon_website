<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class SubAdminRejectedNotification extends Notification
{
    public function __construct(private readonly ?string $reason = null)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Access Not Approved',
            'message' => $this->reason ?? 'Your Sub-Admin access request was not approved.',
            'action_url' => null,
        ];
    }
}