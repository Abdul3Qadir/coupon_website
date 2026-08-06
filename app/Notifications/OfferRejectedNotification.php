<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Notifications\Notification;

class OfferRejectedNotification extends Notification
{
    public function __construct(
        private readonly Offer $offer,
        private readonly ?string $reason = null
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Offer Rejected',
            'message' => $this->reason ?? ('"' . $this->offer->title . '" was not approved.'),
            'action_url' => route('brand.offers.edit', $this->offer),
        ];
    }
}