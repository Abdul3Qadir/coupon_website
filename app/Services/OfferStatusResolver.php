<?php

namespace App\Services;

use App\Enums\OfferStatus;
use App\Models\Admin;

class OfferStatusResolver
{
    public function resolveForBrandSubmission(): array
    {
        $brand = auth('brand')->user();

        return [
            'status' => $brand->auto_publish_offers ? OfferStatus::Approved : OfferStatus::Pending,
            'created_by_type' => 'brand',
            'created_by_admin_id' => null,
        ];
    }

    public function resolveForAdminSubmission(Admin $admin): array
    {
        return [
            'status' => $admin->auto_publish_offers ? OfferStatus::Approved : OfferStatus::Pending,
            'created_by_type' => 'admin',
            'created_by_admin_id' => $admin->id,
        ];
    }
}