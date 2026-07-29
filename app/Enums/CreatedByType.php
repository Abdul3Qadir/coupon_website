<?php

namespace App\Enums;

enum CreatedByType: string
{
    case Brand = 'brand';
    case Admin = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::Brand => 'Brand',
            self::Admin => 'Admin',
        };
    }
}
