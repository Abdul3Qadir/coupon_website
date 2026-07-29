<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationCodeNotification extends Notification
{
    public function __construct(private readonly string $code)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Verify your email address')
            ->greeting('Hello!')
            ->line('Use the code below to verify your email address.')
            ->line('# ' . $this->code)
            ->line('This code will expire in 15 minutes.')
            ->line('If you did not request this, no further action is required.');
    }
}
