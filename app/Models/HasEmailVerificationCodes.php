<?php

namespace App\Models\Concerns;

use App\Models\EmailVerificationCode;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasEmailVerificationCodes
{
    public function emailVerificationCodes(): MorphMany
    {
        return $this->morphMany(EmailVerificationCode::class, 'verifiable');
    }
}
