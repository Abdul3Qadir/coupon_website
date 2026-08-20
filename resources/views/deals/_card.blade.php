@php
    $isExpired = $tab === 'expired';

    // ── Date formatting: years → months → weeks → days ──
    $timeLabel = '';
    $timeClass = 'text-gray-500';
    if ($deal->expires_at) {
        $daysLeft = (int) now()->diffInDays($deal->expires_at, false);
        if ($isExpired) {
            $timeLabel = 'Expired ' . $deal->expires_at->diffForHumans();
            $timeClass = 'text-gray-400';
        } elseif ($daysLeft < 0) {
            $timeLabel = 'Expired';
            $timeClass = 'text-gray-400';
        } elseif ($daysLeft === 0) {
            $timeLabel = 'Ends today';
            $timeClass = 'text-red-600 font-semibold';
        } elseif ($daysLeft === 1) {
            $timeLabel = 'Ends tomorrow';
            $timeClass = 'text-amber-600 font-semibold';
        } elseif ($daysLeft < 14) {
            $timeLabel = "Ends in {$daysLeft} days";
            $timeClass = 'text-amber-600 font-semibold';
        } elseif ($daysLeft < 60) {
            $weeks = (int) ceil($daysLeft / 7);
            $timeLabel = "Ends in {$weeks} " . ($weeks === 1 ? 'week' : 'weeks');
            $timeClass = 'text-gray-500';
        } elseif ($daysLeft < 365) {
            $months = (int) floor($daysLeft / 30);
            $timeLabel = "Ends in {$months} " . ($months === 1 ? 'month' : 'months');
            $timeClass = 'text-gray-500';
        } else {
            $years = (int) floor($daysLeft / 365);
            $remainingDays = $daysLeft % 365;
            $months = (int) floor($remainingDays / 30);
            if ($months > 0) {
                $timeLabel = "Ends in {$years} " . ($years === 1 ? 'year' : 'years') . " {$months} " . ($months === 1 ? 'month' : 'months');
            } else {
                $timeLabel = "Ends in {$years} " . ($years === 1 ? 'year' : 'years');
            }
            $timeClass = 'text-gray-500';
        }
    } else {
        $timeLabel = 'No expiry';
        $timeClass = 'text-gray-500';
    }

    $isEndingSoon = !$isExpired && isset($daysLeft) && $daysLeft >= 0 && $daysLeft <= 3;

    // ── Logo: large_logo first, fallback to small_logo ──
    $logoUrl = null;
    if ($deal->brand) {
        if ($deal->brand->large_logo) {
            $logoUrl = asset('storage/' . $deal->brand->large_logo);
        } elseif ($deal->brand->small_logo) {
            $logoUrl = asset('storage/' . $deal->brand->small_logo);
        }
    }
    $brandName = $deal->brand?->name ?? 'Brand';
@endphp

<a href="{{ route('offers.redirect', $deal) }}" target="_blank" rel="noopener"
   class="deals-card {{ $isExpired ? 'deals-card--expired' : '' }}">

    {{-- Ending Soon Ribbon --}}
    @if($isEndingSoon)
    <div class="deals-ribbon deals-ribbon--ending">
        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
        Ending Soon
    </div>
    @endif

    <div class="p-4 sm:p-5 lg:p-6 flex flex-col h-full">
        {{-- Header: Logo + Discount --}}
        <div class="flex items-center justify-between mb-4 sm:mb-5 gap-3">
            <div class="deals-logo-box {{ $isExpired ? 'deals-logo-box--expired' : '' }}">
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $brandName }}" loading="lazy">
                @else
                    <div class="deals-logo-fallback">{{ strtoupper(substr($brandName, 0, 1)) }}</div>
                @endif
            </div>
            <span class="deals-discount-badge {{ $isExpired ? 'deals-discount-badge--expired' : 'deals-discount-badge--active' }}">
                @if($deal->discount_type->value === 'percentage')
                    {{ $deal->discount_value }}% OFF
                @elseif($deal->discount_type->value === 'fixed')
                    Rs. {{ number_format($deal->discount_value) }} OFF
                @else
                    Free Shipping
                @endif
            </span>
        </div>

        {{-- Content --}}
        <div class="grow">
            <div class="flex items-center gap-2 mb-2 flex-wrap">
                @if($deal->clicks_count > 50)
                <span class="inline-flex items-center gap-0.5 rounded-full bg-emerald-50 px-2 py-0.5 font-Inter text-[10px] font-semibold text-emerald-600">
                    <svg class="h-2.5 w-2.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    {{ number_format($deal->clicks_count) }} used
                </span>
                @endif
            </div>

            <h3 class="font-Manrope text-base sm:text-lg font-bold leading-snug {{ $isExpired ? 'text-gray-500' : 'text-gray-900' }} {{ !$isExpired ? 'group-hover:text-red-600' : '' }} transition-colors">
                {{ $deal->title }}
            </h3>
            <p class="mt-2 text-xs sm:text-sm {{ $isExpired ? 'text-gray-400' : 'text-gray-600' }} line-clamp-3 leading-relaxed">
                {{ $deal->description }}
            </p>
        </div>

        {{-- Footer --}}
        <div class="mt-4 sm:mt-5 flex items-center justify-between pt-3 sm:pt-4 border-t border-gray-100">
            <span class="inline-flex items-center gap-1.5 font-Inter text-xs {{ $timeClass }}">
                <svg class="h-3.5 w-3.5 {{ $isExpired ? 'text-gray-400' : ($isEndingSoon ? 'text-amber-500' : 'text-red-500') }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $timeLabel }}
            </span>

            <span class="inline-flex items-center gap-1 font-Manrope text-xs font-bold {{ $isExpired ? 'text-gray-400' : 'text-gray-900 group-hover:text-red-600' }} transition-colors">
                @if($isExpired)
                    Expired
                @else
                    Get Deal
                    <svg class="h-4 w-4 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                @endif
            </span>
        </div>
    </div>
</a>
