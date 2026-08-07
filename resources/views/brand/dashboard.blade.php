<x-layouts.brand title="Dashboard">
    <div>
        <h1 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">Welcome back, {{ explode(' ', auth('brand')->user()->name)[0] }}</h1>
        <p class="mt-1 font-Inter text-sm text-gray-500">Here's how your coupons and deals are doing.</p>
    </div>

    <a href="{{ route('brand.offers.create') }}" class="mt-6 flex items-center justify-between gap-4 rounded-2xl bg-linear-to-br from-red-500 to-rose-600 p-6 text-white transition hover:shadow-lg hover:shadow-red-200">
        <div>
            <p class="font-Manrope text-lg sm:text-xl font-extrabold">+ Add a New Coupon or Deal</p>
            <p class="mt-1 font-Inter text-sm text-white/80">It only takes a minute. Click here to get started.</p>
        </div>
        <span class="hidden sm:flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-white/20">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </span>
    </a>

    <div class="mt-6 grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-2xl border border-gray-200 bg-white p-5">
            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-red-600">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41L11 3.83A2 2 0 009.59 3.24H4a1 1 0 00-1 1v5.59a2 2 0 00.59 1.41l9.58 9.58a2 2 0 002.82 0l5.59-5.59a2 2 0 000-2.82z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg>
            </span>
            <p class="mt-3 font-Manrope text-2xl font-extrabold text-gray-900">{{ $totalOffers }}</p>
            <p class="font-Inter text-sm text-gray-500">All Coupons &amp; Deals</p>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5">
            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </span>
            <p class="mt-3 font-Manrope text-2xl font-extrabold text-gray-900">{{ $liveOffers }}</p>
            <p class="font-Inter text-sm text-gray-500">Live Right Now</p>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5">
            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            </span>
            <p class="mt-3 font-Manrope text-2xl font-extrabold text-gray-900">{{ $pendingOffers }}</p>
            <p class="font-Inter text-sm text-gray-500">Waiting for Review</p>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5">
            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </span>
            <p class="mt-3 font-Manrope text-2xl font-extrabold text-gray-900">{{ $totalViews }}</p>
            <p class="font-Inter text-sm text-gray-500">Total Views</p>
        </div>
    </div>

    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-5">
        <p class="font-Manrope text-base font-bold text-gray-900">Your Coupons &amp; Deals</p>

        <div class="mt-4 divide-y divide-gray-100">
            @forelse ($recentOffers as $offer)
                <div class="flex items-center justify-between gap-3 py-4">
                    <div class="min-w-0">
                        <p class="font-Manrope text-sm font-bold text-gray-900 truncate">{{ $offer->title }}</p>
                        <p class="mt-0.5 font-Inter text-xs text-gray-500">{{ ucfirst($offer->type->value) }} · Added {{ $offer->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <x-status-badge :status="$offer->status" />
                        <a href="{{ route('brand.offers.edit', $offer) }}" class="font-Inter text-sm font-semibold text-red-600 hover:text-red-700">Edit</a>
                    </div>
                </div>
            @empty
                <div class="py-10 text-center">
                    <p class="font-Inter text-sm text-gray-500">You haven't added any coupons or deals yet.</p>
                    <a href="{{ route('brand.offers.create') }}" class="mt-3 inline-flex items-center gap-1.5 rounded-full bg-red-600 hover:bg-red-700 px-5 py-2.5 font-Manrope text-sm font-bold text-white transition">
                        Add Your First Coupon
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.brand>
