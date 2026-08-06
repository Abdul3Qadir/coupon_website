<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferApprovedNotification extends Notification
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
            ->subject('Your offer is now live')
            ->greeting('Great news!')
            ->line('Your offer "' . $this->offer->title . '" has been approved and is now live on Coupono.')
            ->action('View Dashboard', route('brand.offers.index'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Offer Approved',
            'message' => '"' . $this->offer->title . '" is now live.',
        ];
    }
}