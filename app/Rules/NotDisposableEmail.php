<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotDisposableEmail implements ValidationRule
{
    protected array $blockedDomains = [
        'mailinator.com',
        'tempmail.com',
        'temp-mail.org',
        'guerrillamail.com',
        'guerrillamail.info',
        '10minutemail.com',
        '10minutemail.net',
        'yopmail.com',
        'throwawaymail.com',
        'trashmail.com',
        'fakeinbox.com',
        'getnada.com',
        'dispostable.com',
        'sharklasers.com',
        'maildrop.cc',
        'mintemail.com',
        'mailnesia.com',
        'mohmal.com',
        'emailondeck.com',
        'moakt.com',
        'burnermail.io',
        'discard.email',
        'spamgourmet.com',
        'mailcatch.com',
        'tempinbox.com',
        'inboxkitten.com',
        'mytemp.email',
        'crazymailing.com',
        'anonaddy.me',
        '33mail.com',
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value) || !str_contains($value, '@')) {
            return;
        }

        $domain = strtolower(trim(substr(strrchr($value, '@'), 1)));

        if (in_array($domain, $this->blockedDomains, true)) {
            $fail('Please use a permanent email address. Disposable or temporary email addresses are not allowed.');
        }
    }
}
