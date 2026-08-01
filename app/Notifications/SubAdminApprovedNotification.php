<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubAdminApprovedNotification extends Notification
{
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your admin access has been approved')
            ->greeting('Welcome aboard!')
            ->line('Your Sub-Admin access has been approved. You can now manage offers and blogs.')
            ->action('Go to Dashboard', route('admin.dashboard'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Access Approved',
            'message' => 'Your Sub-Admin access has been approved.',
        ];
    }
}