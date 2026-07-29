<x-layouts.admin title="Dashboard">
    <div class="flex items-center justify-between flex-wrap gap-2">
        <div>
            <h1 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }}, {{ explode(' ', auth('admin')->user()->name)[0] }}</h1>
            <p class="mt-1 font-Inter text-sm text-gray-500">{{ now()->format('l, F j, Y') }} — here's what's happening today.</p>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-2 lg:grid-cols-4 gap-4">
        <x-admin.stat-card label="Total Brands" :value="$totalBrands" />
        <x-admin.stat-card label="Pending Approvals" :value="$pendingBrandsCount + $pendingOffersCount" />
        <x-admin.stat-card label="Live Offers" :value="$liveOffersCount" />
        <x-admin.stat-card label="Total Blogs" :value="$totalBlogs" />
    </div>

    <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="rounded-2xl border border-gray-200 bg-white p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-Manrope text-base font-bold text-gray-900">Pending Approvals</p>
                    <p class="font-Inter text-xs text-gray-500">Brands and offers waiting for review</p>
                </div>
                <a href="#" class="font-Inter text-xs font-semibold text-red-600 hover:text-red-700">View all</a>
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
                <a href="#" class="font-Inter text-xs font-semibold text-red-600 hover:text-red-700">View all</a>
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
