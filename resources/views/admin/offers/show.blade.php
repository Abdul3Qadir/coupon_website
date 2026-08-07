<x-layouts.admin title="Offer Details">
    <div class="mb-6">
        <a href="{{ route('admin.offers.index') }}" class="inline-flex items-center gap-1.5 font-Inter text-sm font-semibold text-gray-500 hover:text-gray-700 transition">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            Back to Offers
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-2xl bg-white border border-gray-200 p-6 sm:p-8">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="inline-flex items-center rounded-full px-2.5 py-1 font-Inter text-xs font-semibold {{ $offer->type->value === 'coupon' ? 'bg-blue-50 text-blue-700' : 'bg-purple-50 text-purple-700' }}">
                                {{ ucfirst($offer->type->value) }}
                            </span>
                            <x-status-badge :status="$offer->status->value" />
                        </div>
                        <h1 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">{{ $offer->title }}</h1>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="rounded-xl bg-gray-100 p-4">
                        <p class="font-Inter text-xs font-semibold text-gray-500 uppercase tracking-wider">Discount</p>
                        <p class="mt-1 font-Manrope text-lg font-extrabold text-gray-900">
                            @if($offer->discount_value)
                                {{ $offer->discount_value }}{{ $offer->discount_type->value === 'percentage' ? '%' : ' flat off' }}
                            @else
                                —
                            @endif
                        </p>
                    </div>
                    <div class="rounded-xl bg-gray-100 p-4">
                        <p class="font-Inter text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</p>
                        <p class="mt-1 font-Manrope text-lg font-extrabold text-gray-900">{{ $offer->category->name ?? 'Uncategorized' }}</p>
                    </div>
                    <div class="rounded-xl bg-gray-100 p-4">
                        <p class="font-Inter text-xs font-semibold text-gray-500 uppercase tracking-wider">Valid From</p>
                        <p class="mt-1 font-Inter text-sm font-semibold text-gray-900">{{ $offer->starts_at ? $offer->starts_at->format('M d, Y') : 'Immediately' }}</p>
                    </div>
                    <div class="rounded-xl bg-gray-100 p-4">
                        <p class="font-Inter text-xs font-semibold text-gray-500 uppercase tracking-wider">Expires</p>
                        <p class="mt-1 font-Inter text-sm font-semibold text-gray-900">{{ $offer->expires_at ? $offer->expires_at->format('M d, Y') : 'No expiry' }}</p>
                    </div>
                </div>

                @if($offer->code)
                    <div class="mt-6">
                        <p class="font-Inter text-xs font-semibold text-gray-500 uppercase tracking-wider">Coupon Code</p>
                        <div class="mt-2 inline-flex items-center gap-2 rounded-xl bg-gray-900 px-4 py-2.5">
                            <span class="font-Inter text-sm font-bold text-white tracking-widest">{{ $offer->code }}</span>
                        </div>
                    </div>
                @endif

                @if($offer->description)
                    <div class="mt-6">
                        <p class="font-Inter text-xs font-semibold text-gray-500 uppercase tracking-wider">Description</p>
                        <p class="mt-2 font-Inter text-sm text-gray-700 leading-relaxed">{{ $offer->description }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-2xl bg-white border border-gray-200 p-6">
                <h3 class="font-Manrope text-sm font-extrabold text-gray-900 uppercase tracking-wider">Brand</h3>
                <div class="mt-4 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-red-50">
                        <span class="font-Manrope text-sm font-bold text-red-600">{{ substr($offer->brand->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-Inter text-sm font-semibold text-gray-900">{{ $offer->brand->name }}</p>
                        <p class="font-Inter text-xs text-gray-500">{{ $offer->brand->email }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-white border border-gray-200 p-6">
                <h3 class="font-Manrope text-sm font-extrabold text-gray-900 uppercase tracking-wider">Meta</h3>
                <div class="mt-4 space-y-3">
                    <div class="flex justify-between">
                        <span class="font-Inter text-xs text-gray-500">Created</span>
                        <span class="font-Inter text-xs font-semibold text-gray-900">{{ $offer->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-Inter text-xs text-gray-500">By</span>
                        <span class="font-Inter text-xs font-semibold text-gray-900">
                            @if($offer->created_by_type && $offer->created_by_type->value === 'brand')
                                {{ $offer->brand->name }} <span class="text-gray-400 font-normal">(Brand)</span>
                            @else
                                {{ $offer->createdByAdmin?->name ?? 'Admin' }} <span class="text-gray-400 font-normal">(Admin)</span>
                            @endif
                        </span>
                    </div>
                    @if($offer->verified_by)
                        <div class="flex justify-between">
                            <span class="font-Inter text-xs text-gray-500">Verified By</span>
                            <span class="font-Inter text-xs font-semibold text-gray-900">{{ $offer->verifier->name ?? '—' }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="font-Inter text-xs text-gray-500">Views</span>
                        <span class="font-Inter text-xs font-semibold text-gray-900">{{ $offer->views_count }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-Inter text-xs text-gray-500">Clicks</span>
                        <span class="font-Inter text-xs font-semibold text-gray-900">{{ $offer->clicks_count }}</span>
                    </div>
                </div>
            </div>

            @if(auth('admin')->user()->isSuperAdmin() && $offer->status->value === 'pending')
                <div class="rounded-2xl bg-white border border-gray-200 p-6 space-y-3">
                    <h3 class="font-Manrope text-sm font-extrabold text-gray-900 uppercase tracking-wider">Actions</h3>
                    <form method="POST" action="{{ route('admin.offers.approve', $offer) }}">
                        @csrf
                        <button type="submit" class="w-full inline-flex items-center cursor-pointer justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 font-Inter text-sm font-semibold text-white hover:bg-emerald-700 transition">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                            Approve Offer
                        </button>
                    </form>
                    <button type="button" class="reject-offer-btn w-full cursor-pointer inline-flex items-center justify-center gap-2 rounded-xl bg-red-50 px-4 py-2.5 font-Inter text-sm font-semibold text-red-600 hover:bg-red-100 transition" data-offer-id="{{ $offer->id }}" data-offer-title="{{ $offer->title }}">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        Reject Offer
                    </button>
                </div>
            @endif
        </div>
    </div>

    <x-reject-offer-modal />
</x-layouts.admin>