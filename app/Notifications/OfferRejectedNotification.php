<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Notifications\Messages\MailMessage;
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
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('Your offer was not approved')
            ->greeting('Hello,')
            ->line('Your offer "' . $this->offer->title . '" was not approved.');

        if ($this->reason) {
            $mail->line('Reason: ' . $this->reason);
        }

        return $mail->action('Edit Offer', route('brand.offers.edit', $this->offer));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Offer Rejected',
            'message' => $this->reason ?? ('"' . $this->offer->title . '" was not approved.'),
        ];
    }
}