<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BrandAutoPublishEnabledNotification extends Notification
{
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Auto-publish enabled for your account')
            ->greeting('Hello,')
            ->line('Great news! Your coupons and deals will now go live automatically without waiting for manual review.')
            ->line('You can still edit or remove any offer at any time from your dashboard.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Auto-Publish Enabled',
            'message' => 'Your offers will now be published automatically without review.',
        ];
    }
}