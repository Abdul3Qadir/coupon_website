<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class SubAdminAutoPublishToggledNotification extends Notification
{
    public function __construct(public bool $enabled)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Auto-Publish Enabled',
            'message' => 'Super Admin has enabled auto-publish for your offers. Your offers will now be published automatically without manual review.',
            'action_url' => route('admin.dashboard'),
        ];
    }
}