<x-layouts.admin title="Offers">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">
                {{ $isSuperAdmin ? 'All Offers' : 'My Offers' }}
            </h1>
            <p class="mt-1 font-Inter text-sm text-gray-500">
                {{ $isSuperAdmin ? 'Review and manage all coupons & deals' : 'Offers you have submitted' }}
            </p>
        </div>
        <a href="{{ route('admin.offers.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 px-5 py-2.5 font-Inter text-sm font-semibold text-white hover:bg-red-700 transition">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
            Add Offer
        </a>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 font-Inter text-sm font-medium text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-6 flex flex-wrap items-center gap-2">
        <a href="{{ route('admin.offers.index', ['status' => 'all']) }}" class="inline-flex items-center rounded-full px-4 py-1.5 font-Inter text-xs sm:text-sm font-semibold transition {{ $activeStatus === 'all' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">All</a>
        <a href="{{ route('admin.offers.index', ['status' => 'pending']) }}" class="inline-flex items-center rounded-full px-4 py-1.5 font-Inter text-xs sm:text-sm font-semibold transition {{ $activeStatus === 'pending' ? 'bg-amber-500 text-white' : 'bg-amber-50 text-amber-700 hover:bg-amber-100' }}">Pending</a>
        <a href="{{ route('admin.offers.index', ['status' => 'approved']) }}" class="inline-flex items-center rounded-full px-4 py-1.5 font-Inter text-xs sm:text-sm font-semibold transition {{ $activeStatus === 'approved' ? 'bg-emerald-600 text-white' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">Approved</a>
        <a href="{{ route('admin.offers.index', ['status' => 'rejected']) }}" class="inline-flex items-center rounded-full px-4 py-1.5 font-Inter text-xs sm:text-sm font-semibold transition {{ $activeStatus === 'rejected' ? 'bg-red-600 text-white' : 'bg-red-50 text-red-700 hover:bg-red-100' }}">Rejected</a>
    </div>

    <div class="rounded-2xl bg-white border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 font-Manrope text-xs font-bold text-gray-500 uppercase tracking-wider">Offer</th>
                        <th class="px-6 py-4 font-Manrope text-xs font-bold text-gray-500 uppercase tracking-wider">Brand</th>
                        <th class="px-6 py-4 font-Manrope text-xs font-bold text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 font-Manrope text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 font-Manrope text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 font-Manrope text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($offers as $offer)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4">
                                <div class="font-Inter text-sm font-semibold text-gray-900">{{ $offer->title }}</div>
                                <div class="mt-0.5 font-Inter text-xs text-gray-500">
                                    @if($offer->discount_value)
                                        {{ $offer->discount_value }}{{ $offer->discount_type->value === 'percentage' ? '%' : ' off' }}
                                    @else
                                        Special Deal
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 font-Inter text-sm text-gray-700">{{ $offer->brand->name }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full px-2.5 py-1 font-Inter text-xs font-semibold {{ $offer->type->value === 'coupon' ? 'bg-blue-50 text-blue-700' : 'bg-purple-50 text-purple-700' }}">
                                    {{ ucfirst($offer->type->value) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <x-status-badge :status="$offer->status->value" />
                            </td>
                            <td class="px-6 py-4 font-Inter text-xs text-gray-500">{{ $offer->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.offers.show', $offer) }}" class="inline-flex items-center gap-1.5 rounded-lg bg-gray-100 px-3 py-1.5 font-Inter text-xs font-semibold text-gray-700 hover:bg-gray-200 transition">
                                        View
                                    </a>
                                    @if($isSuperAdmin && $offer->status->value === 'pending')
                                        <form method="POST" action="{{ route('admin.offers.approve', $offer) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-3 py-1.5 font-Inter text-xs font-semibold text-emerald-700 hover:bg-emerald-100 transition">
                                                Approve
                                            </button>
                                        </form>
                                        <button type="button" class="reject-offer-btn inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-1.5 font-Inter text-xs font-semibold text-red-600 hover:bg-red-100 transition" data-offer-id="{{ $offer->id }}" data-offer-title="{{ $offer->title }}">
                                            Reject
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gray-100">
                                    <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.91 8.84 8.56 2.23a1.93 1.93 0 0 0-1.81 0L3.1 4.13a2.12 2.12 0 0 0-.05 3.69l12.36 6.64a1.93 1.93 0 0 0 1.81 0l3.65-1.9a2.12 2.12 0 0 0 .04-3.72Z"/><path d="m3.09 8.84 12.35 6.63a1.93 1.93 0 0 0 1.81 0l3.65-1.9a2.12 2.12 0 0 0 .05-3.69L8.56 2.23a1.93 1.93 0 0 0-1.81 0L3.1 4.13a2.12 2.12 0 0 0-.05 3.69Z"/><path d="M12 22.78V12.5"/></svg>
                                </div>
                                <h3 class="mt-3 font-Manrope text-sm font-semibold text-gray-900">No offers found</h3>
                                <p class="mt-1 font-Inter text-sm text-gray-500">
                                    {{ $activeStatus === 'pending' ? 'No offers waiting for review.' : 'No offers match your filter.' }}
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($offers->hasPages())
            <div class="border-t border-gray-200 px-6 py-4">
                {{ $offers->links() }}
            </div>
        @endif
    </div>

    <x-reject-offer-modal />
</x-layouts.admin>