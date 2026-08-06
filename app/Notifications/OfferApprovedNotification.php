<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Notifications\Notification;

class OfferApprovedNotification extends Notification
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
            'title' => 'Offer Approved',
            'message' => '"' . $this->offer->title . '" is now live.',
            'action_url' => route('brand.offers.index'),
        ];
    }
}