<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferAddedByAdminNotification extends Notification
{
    public function __construct(private readonly Offer $offer)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('A new offer was added to your account')
            ->greeting('Hello,')
            ->line('Our team added a new coupon/deal for your brand: "' . $this->offer->title . '"')
            ->line('You can review, edit, or remove it anytime from your dashboard.')
            ->action('View Offer', route('brand.offers.index'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Offer Added',
            'message' => 'An admin added "' . $this->offer->title . '" to your account.',
        ];
    }
}