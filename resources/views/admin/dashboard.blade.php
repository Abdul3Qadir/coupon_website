<x-layouts.admin title="Dashboard">
    <div class="flex items-center justify-between flex-wrap gap-2">
        <div>
            <h1 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }}, {{ explode(' ', auth('admin')->user()->name)[0] }}</h1>
            <p class="mt-1 font-Inter text-sm text-gray-500">{{ now()->format('l, F j, Y') }} — here's what's happening today.</p>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-2 lg:grid-cols-4 gap-4">
        <x-admin.stat-card label="Total Brands" :value="$totalBrands" color="red">
            <x-slot:icon><svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21V7l9-4 9 4v14"/><path d="M9 21V12h6v9"/></svg></x-slot:icon>
        </x-admin.stat-card>

        <x-admin.stat-card label="Pending Approvals" :value="$pendingBrandsCount + $pendingOffersCount" color="amber">
            <x-slot:icon><svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></x-slot:icon>
        </x-admin.stat-card>

        <x-admin.stat-card label="Live Offers" :value="$liveOffersCount" color="emerald">
            <x-slot:icon><svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41L11 3.83A2 2 0 009.59 3.24H4a1 1 0 00-1 1v5.59a2 2 0 00.59 1.41l9.58 9.58a2 2 0 002.82 0l5.59-5.59a2 2 0 000-2.82z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg></x-slot:icon>
        </x-admin.stat-card>

        <x-admin.stat-card label="Total Blogs" :value="$totalBlogs" color="violet">
            <x-slot:icon><svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg></x-slot:icon>
        </x-admin.stat-card>
    </div>

    <div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 rounded-2xl border border-gray-200 bg-white p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-Manrope text-base font-bold text-gray-900">Offers Submitted</p>
                    <p class="font-Inter text-xs text-gray-500">Last 7 days</p>
                </div>
                <span class="rounded-full bg-red-50 px-2.5 py-1 font-Inter text-xs font-semibold text-red-600">{{ array_sum($offersLast7Days) }} total</span>
            </div>
            <div class="mt-6">
                <x-admin.mini-bar-chart :data="$offersLast7Days" color="red" />
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5">
            <p class="font-Manrope text-base font-bold text-gray-900">Verification Queue</p>
            <p class="font-Inter text-xs text-gray-500">What still needs your review</p>

            <div class="mt-4 space-y-4">
                <div>
                    <div class="flex items-center justify-between font-Inter text-xs mb-1.5">
                        <span class="text-gray-600">Brand Registrations</span>
                        <span class="font-semibold text-gray-900">{{ $pendingBrandsCount }}</span>
                    </div>
                    <div class="h-1.5 w-full rounded-full bg-gray-100">
                        <div class="h-full rounded-full bg-amber-500" style="width: {{ $pendingBrandsCount > 0 ? min(100, $pendingBrandsCount * 10) : 0 }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between font-Inter text-xs mb-1.5">
                        <span class="text-gray-600">Offers Pending</span>
                        <span class="font-semibold text-gray-900">{{ $pendingOffersCount }}</span>
                    </div>
                    <div class="h-1.5 w-full rounded-full bg-gray-100">
                        <div class="h-full rounded-full bg-red-500" style="width: {{ $pendingOffersCount > 0 ? min(100, $pendingOffersCount * 5) : 0 }}%"></div>
                    </div>
                </div>
                @if ($pendingSubAdminsCount ?? false)
                <div>
                    <div class="flex items-center justify-between font-Inter text-xs mb-1.5">
                        <span class="text-gray-600">Sub-Admin Requests</span>
                        <span class="font-semibold text-gray-900">{{ $pendingSubAdminsCount }}</span>
                    </div>
                    <div class="h-1.5 w-full rounded-full bg-gray-100">
                        <div class="h-full rounded-full bg-violet-500" style="width: {{ min(100, $pendingSubAdminsCount * 20) }}%"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="rounded-2xl border border-gray-200 bg-white p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-Manrope text-base font-bold text-gray-900">Pending Approvals</p>
                    <p class="font-Inter text-xs text-gray-500">Brands waiting for review</p>
                </div>
                <a href="{{route('admin.brands.index')}}" class="font-Inter text-xs font-semibold text-red-600 hover:text-red-700">View all</a>
            </div>

            <div class="mt-4 divide-y divide-gray-100">
                @forelse ($pendingBrands as $brand)
                    <div class="flex items-center justify-between gap-3 py-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <x-avatar :name="$brand->name" size="sm" />
                            <div class="min-w-0">
                                <p class="font-Manrope text-sm font-bold text-gray-900 truncate">{{ $brand->name }}</p>
                                <p class="font-Inter text-xs text-gray-500">Brand registration · {{ $brand->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <x-status-badge :status="$brand->status" />
                    </div>
                @empty
                    <p class="py-6 text-center font-Inter text-sm text-gray-400">Nothing pending right now.</p>
                @endforelse
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-Manrope text-base font-bold text-gray-900">Recent Offers</p>
                    <p class="font-Inter text-xs text-gray-500">Latest coupons and deals submitted</p>
                </div>
                <a href="{{route('admin.offers.index')}}" class="font-Inter text-xs font-semibold text-red-600 hover:text-red-700">View all</a>
            </div>

            <div class="mt-4 divide-y divide-gray-100">
                @forelse ($recentOffers as $offer)
                    <div class="flex items-center justify-between gap-3 py-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <x-avatar :name="$offer->brand->name" size="sm" />
                            <div class="min-w-0">
                                <p class="font-Manrope text-sm font-bold text-gray-900 truncate">{{ $offer->title }}</p>
                                <p class="font-Inter text-xs text-gray-500">{{ $offer->brand->name }} · {{ $offer->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <x-status-badge :status="$offer->status" />
                    </div>
                @empty
                    <p class="py-6 text-center font-Inter text-sm text-gray-400">No offers submitted yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.admin>