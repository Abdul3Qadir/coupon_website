@forelse ($stores as $store)
    <a href="{{ route('stores.show', $store) }}" class="store-card group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
        <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
            @if ($store->small_logo)
                <img src="{{ asset('storage/' . $store->small_logo) }}" alt="{{ $store->name }}" class="max-h-16 object-contain">
            @else
                <x-avatar :name="$store->name" />
            @endif
        </div>
        <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">{{ $store->name }}</p>
        @if ($store->category)
            <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">{{ $store->category->name }}</span>
        @endif
        <span class="mt-1.5 font-Inter text-xs text-gray-500">{{ $store->offers_count }} coupons</span>
    </a>
@empty
    <p class="col-span-full text-center font-Inter text-sm text-gray-500 py-14">No stores match this filter.</p>
@endforelse