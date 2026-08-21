<section class="py-14 sm:py-20">
    <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
        <div class="text-center">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3.5 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-red-600">
                <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41L11 3.83A2 2 0 009.59 3.24H4a1 1 0 00-1 1v5.59a2 2 0 00.59 1.41l9.58 9.58a2 2 0 002.82 0l5.59-5.59a2 2 0 000-2.82z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg>
                Live Right Now
            </span>
            <h2 class="mt-4 font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">Top Coupons &amp; Deals</h2>
            <p class="mx-auto mt-3 max-w-xl font-Inter text-sm sm:text-base text-gray-600">Hand-tested codes you can copy and use right now</p>
        </div>

        <div class="mt-10 sm:mt-12 grid grid-cols-1 min-[500px]:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7">
            @forelse ($topCoupons as $coupon)
            <div class="flex flex-col rounded-2xl bg-white border border-gray-200 shadow-sm overflow-hidden transition hover:shadow-lg hover:border-red-200">
                <div class="flex items-center justify-between p-5 pb-4">
                    <div class="flex h-12 w-28 items-center justify-center rounded-xl border border-gray-200 bg-white px-3">
                        @if($coupon->brand && $coupon->brand->large_logo)
                            <img src="{{ asset('storage/' . $coupon->brand->large_logo) }}" alt="{{ $coupon->brand->name }}" class="max-h-10 object-contain">
                        @else
                            <span class="font-Manrope text-sm font-bold text-gray-400">{{ $coupon->brand->name ?? 'Brand' }}</span>
                        @endif
                    </div>
                    @if($coupon->brand && $coupon->brand->verified_at)
                    <span class="inline-flex items-center gap-1 font-Inter text-[11px] font-semibold text-emerald-600">
                        <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Verified
                    </span>
                    @endif
                </div>

                <div class="px-5">
                    <p class="font-Manrope text-xl font-extrabold text-red-600">
                        @if($coupon->discount_type?->value === 'percentage')
                            {{ round($coupon->discount_value) }}% OFF
                        @elseif($coupon->discount_type?->value === 'fixed')
                            Rs. {{ number_format($coupon->discount_value) }} OFF
                        @elseif($coupon->discount_type?->value === 'free_shipping')
                            FREE SHIPPING
                        @else
                            {{ $coupon->title }}
                        @endif
                    </p>
                    <p class="mt-0.5 font-Inter text-sm text-gray-600">{{ $coupon->description ?? 'Special offer available now' }}</p>
                </div>

                <div class="p-5 pt-4">
                    <div class="coupon-code-box relative overflow-hidden rounded-lg border-2 border-dashed border-gray-300 bg-gray-50">
                        <div class="flex items-center justify-between gap-3 px-3 py-2.5">
                            <span class="coupon-code-text blur-sm select-none transition font-Manrope text-sm sm:text-base font-bold tracking-widest text-gray-900 uppercase">{{ $coupon->code ?? 'NO CODE' }}</span>
                            <button type="button" class="coupon-copy-again-btn cursor-pointer shrink-0 inline-flex items-center gap-1.5 rounded-md bg-red-600 px-3 py-1.5 font-Inter text-xs font-semibold text-white transition hover:bg-red-700 active:bg-red-800" data-code="{{ $coupon->code ?? '' }}" data-default-label="Copy">
                                <svg class="copy-icon h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="12" height="12" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
                                <span class="copy-label">Copy</span>
                            </button>
                        </div>
                        <button type="button" class="coupon-reveal-btn cursor-pointer absolute inset-0 flex items-center justify-center gap-1.5 bg-gray-50 hover:bg-gray-100 font-Inter text-xs sm:text-sm font-bold text-red-600 transition" data-code="{{ $coupon->code ?? '' }}" data-store-url="{{ $coupon->redirect_url ?? '#' }}">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            Show Code
                        </button>
                    </div>
                    <p class="mt-2 font-Inter text-[11px] {{ $coupon->expires_at && $coupon->expires_at->isToday() ? 'font-semibold text-red-500' : 'text-gray-400' }}">
                        @if($coupon->expires_at)
                            @if($coupon->expires_at->isToday())
                                Expires today
                            @else
                                Expires {{ $coupon->expires_at->diffForHumans() }}
                            @endif
                        @else
                            Limited time offer
                        @endif
                    </p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="font-Inter text-gray-400">No active coupons available right now.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>