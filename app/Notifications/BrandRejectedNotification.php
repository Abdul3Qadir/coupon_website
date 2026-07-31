<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BrandRejectedNotification extends Notification
{
    public function __construct(private readonly ?string $reason = null)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('Your brand registration was not approved')
            ->greeting('Hello,')
            ->line('Unfortunately, your brand registration could not be approved at this time.');

        if ($this->reason) {
            $mail->line('Reason: ' . $this->reason);
        }

        return $mail->line('You can update your details and submit again.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Registration Rejected',
            'message' => $this->reason ?? 'Your brand registration was not approved.',
        ];
    }
}