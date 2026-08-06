<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Notifications\Notification;

class BrandOfferAddedNotification extends Notification
{
    public function __construct(private readonly Offer $offer)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Offer Added',
            'message' => 'An admin added "' . $this->offer->title . '" to your account.',
            'action_url' => route('brand.offers.index'),
        ];
    }
}