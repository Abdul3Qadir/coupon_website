<?php

namespace App\Enums;

enum OfferType: string
{
    case Coupon = 'coupon';
    case Deal = 'deal';

    public function label(): string
    {
        return match ($this) {
            self::Coupon => 'Coupon',
            self::Deal => 'Deal',
        };
    }
}
