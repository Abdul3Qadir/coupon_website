<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class EmailVerificationCode extends Model
{
    protected $fillable = [
        'verifiable_type',
        'verifiable_id',
        'code',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];
    }

    public function verifiable(): MorphTo
    {
        return $this->morphTo();
    }
}
