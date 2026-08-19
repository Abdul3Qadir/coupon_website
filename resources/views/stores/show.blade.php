<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $brand->name }} Coupons &amp; Deals</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    @include("pages-components.navbar")

    <section class="bg-[#f8f9fb] border-b border-gray-200 py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="flex items-center gap-1.5 font-Inter text-xs sm:text-sm text-gray-500 mb-6">
                <a href="{{ route('stores.index') }}" class="hover:text-red-600 transition">Stores</a>
                <span>/</span>
                <span class="text-gray-900 font-semibold">{{ $brand->name }}</span>
            </div>

            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                <div class="flex h-24 w-24 sm:h-28 sm:w-28 shrink-0 items-center justify-center rounded-2xl bg-white border border-gray-200 shadow-sm p-4">
                    @if ($brand->small_logo)
                        <img src="{{ asset('storage/' . $brand->small_logo) }}" alt="{{ $brand->name }}" class="max-h-full max-w-full object-contain">
                    @else
                        <x-avatar :name="$brand->name" size="lg" />
                    @endif
                </div>

                <div class="flex-1 text-center sm:text-left">
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
                        <h1 class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $brand->name }}</h1>
                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 font-Inter text-xs font-semibold text-emerald-600">
                            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Verified
                        </span>
                        @if ($brand->category)
                            <span class="rounded-full bg-violet-50 px-2.5 py-1 font-Inter text-xs font-semibold text-violet-600">{{ $brand->category->name }}</span>
                        @endif
                    </div>

                    <p class="mt-2 font-Inter text-sm sm:text-base text-gray-600 max-w-xl">{{ $brand->short_description }}</p>

                    <div class="mt-5 flex flex-wrap items-center justify-center sm:justify-start gap-x-6 gap-y-2">
                        <div>
                            <p class="font-Manrope text-lg font-extrabold text-gray-900">{{ $coupons->count() + $deals->count() }}</p>
                            <p class="font-Inter text-xs text-gray-500">Coupons &amp; Deals</p>
                        </div>
                        <div class="w-px h-8 bg-gray-200"></div>
                        <div>
                            <p class="font-Manrope text-lg font-extrabold text-gray-900">{{ $bestDiscount ? number_format($bestDiscount) . '%' : '—' }}</p>
                            <p class="font-Inter text-xs text-gray-500">Best Discount</p>
                        </div>
                        <div class="w-px h-8 bg-gray-200"></div>
                        <div>
                            <p class="font-Manrope text-lg font-extrabold text-gray-900">{{ $brand->verified_at?->diffForHumans() ?? '—' }}</p>
                            <p class="font-Inter text-xs text-gray-500">Verified</p>
                        </div>
                    </div>
                </div>

                <a href="{{ $brand->website_url }}" target="_blank" rel="noopener" class="cursor-pointer inline-flex items-center gap-2 rounded-full bg-red-600 hover:bg-red-700 px-6 py-3 font-Manrope text-sm font-bold text-white shadow-sm transition shrink-0">
                    Visit Website
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg>
                </a>
            </div>
        </div>
    </section>

    @if ($coupons->isNotEmpty())
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <h2 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">{{ $brand->name }} Coupons</h2>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                @foreach ($coupons as $offer)
                    <div class="flex flex-col rounded-2xl bg-white border border-gray-200 shadow-sm overflow-hidden transition hover:shadow-lg hover:border-red-200">
                        <div class="flex items-center justify-between p-5 pb-4">
                            <div class="flex h-12 w-28 items-center justify-center rounded-xl border border-gray-200 bg-white px-3">
                                @if ($brand->large_logo)
                                    <img src="{{ asset('storage/' . $brand->large_logo) }}" alt="{{ $brand->name }}" class="max-h-10 object-contain">
                                @else
                                    <x-avatar :name="$brand->name" size="sm" />
                                @endif
                            </div>
                            <span class="inline-flex items-center gap-1 font-Inter text-[11px] font-semibold text-emerald-600">
                                <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Verified
                            </span>
                        </div>

                        <div class="px-5 flex-1">
                            <p class="font-Manrope text-xl font-extrabold text-red-600">
                                @if ($offer->discount_type->value === 'percentage'){{ $offer->discount_value }}% OFF
                                @elseif ($offer->discount_type->value === 'fixed') {{ number_format($offer->discount_value) }} OFF
                                @else Free Shipping @endif
                            </p>
                            <p class="mt-0.5 font-Inter text-sm line-clamp-3 text-gray-600">{{ $offer->description }}</p>
                        </div>
                        <div class="p-5 pt-4">
                            <div class="coupon-code-box relative overflow-hidden rounded-lg border-2 border-dashed border-gray-300 bg-gray-50">
                                <div class="flex items-center justify-between gap-3 px-3 py-2.5">
                                    <span class="coupon-code-text blur-sm select-none transition font-Manrope text-sm sm:text-base font-bold tracking-widest uppercase text-gray-900">{{ $offer->code }}</span>
                                    <button type="button" class="coupon-copy-again-btn cursor-pointer shrink-0 inline-flex items-center gap-1.5 rounded-md bg-red-600 px-3 py-1.5 font-Inter text-xs font-semibold text-white transition hover:bg-red-700 active:bg-red-800" data-code="{{ $offer->code }}" data-default-label="Copy">
                                        <svg class="copy-icon h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="12" height="12" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
                                        <span class="copy-label">Copy</span>
                                    </button>
                                </div>
                                <button type="button" class="coupon-reveal-btn cursor-pointer absolute inset-0 flex items-center justify-center gap-1.5 bg-gray-50 font-Inter text-xs sm:text-sm font-bold text-red-600 transition" data-code="{{ $offer->code }}" data-store-url="{{ route('offers.redirect', $offer) }}">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    Show Code
                                </button>
                            </div>
                            <p class="mt-2 font-Inter text-[11px] text-gray-400">
                                @if ($offer->expires_at) Expires {{ $offer->expires_at->diffForHumans() }} @else No expiry @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if ($deals->isNotEmpty())
    <section class="py-4 sm:py-6">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10 pt-8">
            <h2 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">{{ $brand->name }} Deals</h2>
        </div>
    </section>

    <section class="pb-12 sm:pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($deals as $offer)
                    <a href="{{ route('offers.redirect', $offer) }}" class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                        <div class="relative flex items-center justify-between mb-5">
                            <div class="flex items-center justify-center rounded-xl bg-gray-100 p-2 border border-gray-200">
                                @if ($brand->small_logo)
                                    <img src="{{ asset('storage/' . $brand->small_logo) }}" alt="{{ $brand->name }}" class="max-h-10 w-auto object-contain">
                                @else
                                    <x-avatar :name="$brand->name" size="sm" />
                                @endif
                            </div>
                            <span class="rounded-full bg-red-600 px-3 py-1 font-Manrope text-xs font-bold text-white">
                                @if ($offer->discount_type->value === 'percentage'){{ $offer->discount_value }}% OFF
                                @elseif ($offer->discount_type->value === 'fixed')Rs. {{ number_format($offer->discount_value) }} OFF
                                @else Free Shipping @endif
                            </span>
                        </div>

                        <div class="grow">
                            <h3 class="font-Manrope text-lg font-bold text-gray-900 group-hover:text-red-600 transition-colors">{{ $offer->title }}</h3>
                            <p class="mt-2 text-xs sm:text-sm text-gray-600 line-clamp-3 leading-relaxed">{{ $offer->description }}</p>
                        </div>

                        <div class="mt-6 flex items-center justify-between pt-4 border-t border-gray-100">
                            <span class="inline-flex items-center gap-1 font-Inter text-xs font-medium text-red-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                @if ($offer->expires_at) Ends {{ $offer->expires_at->diffForHumans() }} @else Ongoing @endif
                            </span>
                            <span class="inline-flex items-center gap-1 font-Manrope text-xs font-bold text-gray-900 group-hover:text-red-600 transition-colors">
                                Get Deal
                                <svg class="h-4 w-4 transform transition-transform group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if ($coupons->isEmpty() && $deals->isEmpty())
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10 text-center">
            <p class="font-Inter text-sm text-gray-500">No active coupons or deals from {{ $brand->name }} right now. Check back soon!</p>
        </div>
    </section>
    @endif

    @if ($brand->about_description || $similarStores->isNotEmpty())
        <section class="py-12 sm:py-16 bg-[#f8f9fb] border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                    {{-- About --}}
                    @if ($brand->about_description)
                        <div>
                            <h2 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">
                                About {{ $brand->name }}
                            </h2>
                            <div class="mt-4 font-Inter text-sm sm:text-base text-gray-600 leading-relaxed">
                                <p>{{ $brand->about_description }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Similar Stores --}}
                    @if ($similarStores->isNotEmpty())
                        <div>
                            <h2 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">
                                Similar Stores
                            </h2>
                            <div class="mt-5 grid min-[350px]:grid-cols-2 gap-3">
                                @foreach ($similarStores as $store)
                                    <a href="{{ route('stores.show', $store) }}" class="flex items-center gap-2.5 rounded-xl border border-gray-200 bg-white p-2.5 transition-all duration-200 hover:border-red-200 hover:shadow-sm">
                                        {{-- Logo --}}
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-gray-100 bg-white p-1.5">
                                            @if ($store->small_logo)
                                                <img src="{{ asset('storage/' . $store->small_logo) }}" alt="{{ $store->name }}" class="max-h-7 max-w-full object-contain">
                                            @else
                                                <x-avatar :name="$store->name" size="sm" />
                                            @endif
                                        </div>

                                        {{-- Store Info --}}
                                        <div class="min-w-0">
                                            <p class="font-Manrope text-xs sm:text-sm font-bold text-gray-900 truncate">
                                                {{ $store->name }}
                                            </p>
                                            <p class="mt-0.5 font-Inter text-[11px] sm:text-xs text-gray-500">
                                                {{ $store->offers_count }} Deals & Coupons
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <section class="py-12 sm:py-16 border-t border-gray-200">
        <div class="max-w-3xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <h2 class="text-center font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">How to Use a {{ $brand->name }} Promo?</h2>

            <div class="mt-10 relative">
                <div class="absolute left-5 top-2 bottom-2 w-px bg-gray-200"></div>

                @php
                    $steps = [
                        ['Find Your Offer', "Browse the coupons and deals for {$brand->name} above."],
                        ['Click "Get Code"', "The code copies automatically and {$brand->name} opens in a new tab."],
                        ['Go to Checkout', 'Add your items to the cart on the store site.'],
                        ['Paste the Code', 'Enter it in the promo or coupon field at checkout.'],
                        ['Watch Discount Apply', 'Your savings reflect instantly in the order total.'],
                        ['Report If It Fails', 'Use the feedback button on the offer. Flagged codes are retested within 1–4 hours.'],
                    ];
                @endphp

                @foreach ($steps as $index => $step)
                    <div class="relative flex gap-5 {{ $loop->last ? '' : 'pb-8' }}">
                        <span class="relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-600 font-Manrope text-sm font-bold text-white">{{ $index + 1 }}</span>
                        <div class="pt-1.5">
                            <h3 class="font-Manrope text-base font-bold text-gray-900">{{ $step[0] }}</h3>
                            <p class="mt-1 font-Inter text-sm text-gray-600">{{ $step[1] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if ($expiredCoupons->isNotEmpty())
    <section class="py-12 bg-[#f8f9fb] select-none border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="flex items-center gap-3 mb-2">
                <h2 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">Expired Coupons</h2>
                <span class="rounded-full bg-gray-200 px-2.5 py-1 font-Inter text-xs font-semibold text-gray-600">{{ $expiredCoupons->count() }}</span>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 opacity-70">
                @foreach ($expiredCoupons as $offer)
                    <div class="flex flex-col rounded-2xl bg-white border border-gray-200 shadow-sm overflow-hidden">
                        <div class="flex items-center justify-between p-5 pb-4">
                            <div class="flex h-12 w-28 items-center justify-center rounded-xl border border-gray-200 bg-white px-3 grayscale">
                                @if ($brand->large_logo)
                                    <img src="{{ asset('storage/' . $brand->large_logo) }}" alt="{{ $brand->name }}" class="max-h-10 object-contain">
                                @else
                                    <x-avatar :name="$brand->name" size="sm" />
                                @endif
                            </div>
                            <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-2.5 py-1 font-Inter text-[11px] font-semibold text-gray-500">
                                <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M15 9l-6 6M9 9l6 6"/></svg>
                                Expired
                            </span>
                        </div>

                        <div class="px-5 flex-1">
                            <p class="font-Manrope text-xl font-extrabold text-gray-400 line-through decoration-gray-400">
                                @if ($offer->discount_type->value === 'percentage'){{ $offer->discount_value }}% OFF
                                @elseif ($offer->discount_type->value === 'fixed') {{ number_format($offer->discount_value) }} OFF
                                @else Free Shipping @endif
                            </p>
                            <p class="mt-0.5 font-Inter text-sm line-clamp-3 text-gray-500">{{ $offer->description }}</p>
                        </div>
                        <div class="p-5 pt-4">
                            <div class="relative overflow-hidden rounded-lg border-2 border-dashed border-gray-300 bg-gray-100">
                                <div class="flex items-center justify-between gap-3 px-3 py-2.5">
                                    <span class="font-Manrope text-sm sm:text-base font-bold tracking-widest uppercase text-gray-400 line-through decoration-gray-400">{{ $offer->code }}</span>
                                    <span class="shrink-0 inline-flex items-center gap-1.5 rounded-md bg-gray-400 px-3 py-1.5 font-Inter text-xs font-semibold text-white cursor-not-allowed">
                                        Expired
                                    </span>
                                </div>
                            </div>
                            <p class="mt-2 font-Inter text-[11px] text-gray-400">
                                Expired {{ $offer->expires_at?->diffForHumans() ?? 'recently' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if ($expiredDeals->isNotEmpty())
    <section class="py-12 bg-[#f8f9fb] select-none border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10 pt-8">
            <div class="flex items-center gap-3 mb-2">
                <h2 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">Expired Deals</h2>
                <span class="rounded-full bg-gray-200 px-2.5 py-1 font-Inter text-xs font-semibold text-gray-600">{{ $expiredDeals->count() }}</span>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 opacity-70">
                @foreach ($expiredDeals as $offer)
                    <div class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col">
                        <div class="relative flex items-center justify-between mb-5">
                            <div class="flex items-center justify-center rounded-xl bg-gray-100 p-2 border border-gray-200 grayscale">
                                @if ($brand->small_logo)
                                    <img src="{{ asset('storage/' . $brand->small_logo) }}" alt="{{ $brand->name }}" class="max-h-10 w-auto object-contain">
                                @else
                                    <x-avatar :name="$brand->name" size="sm" />
                                @endif
                            </div>
                            <span class="rounded-full bg-gray-400 px-3 py-1 font-Manrope text-xs font-bold text-white line-through decoration-white">
                                @if ($offer->discount_type->value === 'percentage'){{ $offer->discount_value }}% OFF
                                @elseif ($offer->discount_type->value === 'fixed')Rs. {{ number_format($offer->discount_value) }} OFF
                                @else Free Shipping @endif
                            </span>
                        </div>

                        <div class="grow">
                            <h3 class="font-Manrope text-lg font-bold text-gray-500 line-through decoration-gray-400">{{ $offer->title }}</h3>
                            <p class="mt-2 text-xs sm:text-sm text-gray-500 line-clamp-3 leading-relaxed">{{ $offer->description }}</p>
                        </div>

                        <div class="mt-6 flex items-center justify-between pt-4 border-t border-gray-100">
                            <span class="inline-flex items-center gap-1 font-Inter text-xs font-medium text-gray-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Expired {{ $offer->expires_at?->diffForHumans() ?? 'recently' }}
                            </span>
                            <span class="inline-flex items-center gap-1 font-Manrope text-xs font-bold text-gray-400 cursor-not-allowed">
                                Expired
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @include("pages-components.footer")
</body>
</html>