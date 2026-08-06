<x-layouts.brand title="My Coupons & Deals">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h1 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">My Coupons &amp; Deals</h1>
            <p class="mt-1 font-Inter text-sm text-gray-500">Manage everything you've added</p>
        </div>
        <a href="{{ route('brand.offers.create') }}" class="inline-flex items-center gap-1.5 rounded-full bg-red-600 hover:bg-red-700 px-5 py-2.5 font-Manrope text-sm font-bold text-white transition">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add New
        </a>
    </div>

    @session('status')
        <div class="mt-5 rounded-lg bg-emerald-50 px-4 py-3 font-Inter text-sm font-semibold text-emerald-700">
            {{ $value }}
        </div>
    @endsession

    <div class="mt-6 flex items-center gap-2 overflow-x-auto">
        @foreach (['all' => 'All', 'approved' => 'Live', 'pending' => 'Waiting for Review', 'rejected' => 'Not Approved'] as $key => $label)
            <a href="{{ route('brand.offers.index', ['status' => $key]) }}" @class([
                'shrink-0 inline-flex items-center gap-1.5 rounded-full px-4 py-2 font-Inter text-sm font-semibold transition',
                'bg-gray-900 text-white' => $activeStatus === $key,
                'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' => $activeStatus !== $key,
            ])>
                {{ $label }}
                <span @class([
                    'rounded-full px-1.5 py-0.5 text-xs font-bold',
                    'bg-white/20' => $activeStatus === $key,
                    'bg-gray-100 text-gray-500' => $activeStatus !== $key,
                ])>{{ $statusCounts[$key] }}</span>
            </a>
        @endforeach
    </div>

    <div class="mt-6 rounded-2xl border border-gray-200 bg-white">
        <div class="divide-y divide-gray-100">
            @forelse ($offers as $offer)
                <div class="flex items-center justify-between gap-3 p-5">
                    <div class="min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <p class="font-Manrope text-sm font-bold text-gray-900">{{ $offer->title }}</p>
                            <span class="rounded-full bg-gray-100 px-2 py-0.5 font-Inter text-[10px] font-semibold text-gray-500">{{ ucfirst($offer->type->value) }}</span>
                        </div>
                        <p class="mt-0.5 font-Inter text-xs text-gray-500">Added {{ $offer->created_at->diffForHumans() }}</p>
                        @if ($offer->status->value === 'rejected' && $offer->rejection_reason)
                            <p class="mt-1 font-Inter text-xs text-red-600">{{ $offer->rejection_reason }}</p>
                        @endif
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <x-status-badge :status="$offer->status" />
                        <a href="{{ route('brand.offers.edit', $offer) }}" class="font-Inter mt-0.5 text-sm font-semibold text-red-600 hover:text-red-700">Edit</a>
                        <form method="POST" action="{{ route('brand.offers.destroy', $offer) }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="confirm-action cursor-pointer font-Inter text-sm font-semibold text-gray-400 hover:text-red-600 transition" data-confirm-title="Remove this offer?" data-confirm-message="This will remove &quot;{{ $offer->title }}&quot; permanently." data-confirm-button="Yes, Remove">
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="py-10 text-center">
                    <p class="font-Inter text-sm text-gray-500">Nothing here yet.</p>
                    <a href="{{ route('brand.offers.create') }}" class="mt-3 inline-flex items-center gap-1.5 rounded-full bg-red-600 hover:bg-red-700 px-5 py-2.5 font-Manrope text-sm font-bold text-white transition">
                        Add Your First Coupon
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    @if ($offers->hasPages())
        <div class="mt-6">{{ $offers->links() }}</div>
    @endif
</x-layouts.brand>