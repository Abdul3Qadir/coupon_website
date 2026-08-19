<?php

namespace App\Notifications;

use App\Models\Brand;
use Illuminate\Notifications\Notification;

class BrandFeaturedNotification extends Notification
{
    public function __construct(
        public Brand $brand,
        public bool $isFeatured
    ) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->isFeatured ? '🎉 You\'re Trending!' : 'Removed from Trending',
            'message' => $this->isFeatured 
                ? 'Congratulations! Your brand is now featured in the Trending section. More visibility, more offers!'
                : 'Your brand has been removed from the Trending section.',
            'type' => $this->isFeatured ? 'success' : 'info',
            'icon' => $this->isFeatured ? '🔥' : '📍',
            'actionUrl' => route('brand.dashboard'),
            'actionText' => 'View Dashboard',
        ];
    }
}