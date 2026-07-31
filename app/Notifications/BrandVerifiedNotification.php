<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BrandVerifiedNotification extends Notification
{
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your brand has been verified')
            ->greeting('Congratulations!')
            ->line('Your brand has been verified by our team. Your dashboard is now fully unlocked.')
            ->action('Go to Dashboard', route('brand.dashboard'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Brand Verified',
            'message' => 'Your brand has been verified. Your dashboard is now unlocked.',
        ];
    }
}