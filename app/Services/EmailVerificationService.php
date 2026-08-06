<?php

namespace App\Services;

use App\Models\EmailVerificationCode;
use App\Notifications\EmailVerificationCodeNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class EmailVerificationService
{
    public function generateAndSend(Model $verifiable): void
    {
        $verifiable->emailVerificationCodes()->delete();

        $code = (string) random_int(100000, 999999);

        EmailVerificationCode::create([
            'verifiable_type' => $verifiable::class,
            'verifiable_id' => $verifiable->getKey(),
            'code' => Hash::make($code),
            'expires_at' => now()->addMinutes(15),
        ]);

        //(new EmailVerificationCodeNotification($code));
    }

    public function canResend(Model $verifiable): bool
    {
        return !$verifiable->emailVerificationCodes()
            ->where('created_at', '>=', now()->subSeconds(60))
            ->exists();
    }

    public function verify(Model $verifiable, string $code): bool
    {
        $record = $verifiable->emailVerificationCodes()->latest()->first();

        if (!$record || $record->expires_at->isPast() || !Hash::check($code, $record->code)) {
            return false;
        }

        $verifiable->forceFill(['email_verified_at' => now()])->save();
        $record->delete();

        return true;
    }

    public function verifyCodeOnly(Model $verifiable, string $code): bool
    {
        $record = $verifiable->emailVerificationCodes()->latest()->first();

        if (!$record || $record->expires_at->isPast() || !Hash::check($code, $record->code)) {
            return false;
        }

        $record->delete();

        return true;
    }
}