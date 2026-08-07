<?php

namespace App\Notifications;

use App\Models\Offer;
use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OfferPendingReviewNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Offer $offer,
        public ?Admin $creator = null
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => $this->creator 
                ? "New offer '{$this->offer->title}' by {$this->creator->name} needs review."
                : "New offer '{$this->offer->title}' needs review.",
            'url' => route('admin.offers.show', $this->offer),
            'offer_id' => $this->offer->id,
            'type' => 'pending_review',
        ];
    }
}