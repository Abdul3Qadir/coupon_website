<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubAdminRejectedNotification extends Notification
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
            ->subject('Update on your admin access request')
            ->greeting('Hello,')
            ->line('Your Sub-Admin access request was not approved.');

        if ($this->reason) {
            $mail->line('Reason: ' . $this->reason);
        }

        return $mail;
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Access Not Approved',
            'message' => $this->reason ?? 'Your Sub-Admin access request was not approved.',
        ];
    }
}