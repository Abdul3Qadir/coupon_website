<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class BrandRejectedNotification extends Notification
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
            'title' => 'Registration Rejected',
            'message' => $this->reason ?? 'Your brand registration was not approved.',
            'action_url' => null,
        ];
    }
}