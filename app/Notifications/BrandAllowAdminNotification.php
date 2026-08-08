<?php

namespace App\Notifications;

use App\Models\Brand;
use Illuminate\Notifications\Notification;

class BrandAllowAdminNotification extends Notification
{
    public function __construct(private readonly Brand $brand)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Brand Allows Admin Offers',
            'message' => $this->brand->name . ' has enabled admin offer creation. You can now add coupons and deals on their behalf.',
            'action_url' => route('admin.offers.create'),
        ];
    }
}