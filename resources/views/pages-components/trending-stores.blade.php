<section class="py-12">
    <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
        <div class="text-center">
            <h2 class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">Trending Stores</h2>
            <p class="mt-2 font-Inter text-sm sm:text-base text-gray-600">What everyone's saving with right now</p>
        </div>

        <div class="mt-10 sm:mt-12 grid min-[320px]:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6">
            @forelse ($trendingStores as $store)
            <a href="{{ route('stores.show', $store->slug) }}" class="group relative flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-orange-200">
                <span class="absolute -top-2 left-4 inline-flex items-center gap-1 rounded-full bg-orange-500 px-2.5 py-0.5 font-Inter text-[10px] font-bold uppercase tracking-wide text-white shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" color="#ffffff" fill="none" stroke="#ffffff" stroke-width="2" stroke-linejoin="round">
                        <path d="M12 22C16.1421 22 19.5 18.6421 19.5 14.5C19.5 13.5 19.5 11.5 17.5 9C17.5 9 17.4004 11.8536 15.4262 11.4408C12.2331 10.7732 16.3551 4.50296 10.5 2C10.5 7 4.5 8.5 4.5 14.5C4.5 18.6421 7.85786 22 12 22Z"></path>
                        <path d="M12 19.0011C13.933 19.0011 15.5 16.9864 15.5 14.5011C12.3 15.7011 11.1667 12.9379 11 11C9.55426 11.5532 8.5 13.8256 8.5 15C8.5 17.4853 10.067 19.0011 12 19.0011Z"></path>
                    </svg>
                    Trending
                </span>
                <div class="flex h-16 w-full items-center justify-center rounded-xl bg-gray-100">
                    @if($store->small_logo)
                        <img src="{{ asset('storage/' . $store->small_logo) }}" alt="{{ $store->name }}" class="max-h-18 min-[400px]:max-h-20 object-contain">
                    @else
                        <span class="font-Manrope text-sm font-bold text-gray-400">{{ $store->name }}</span>
                    @endif
                </div>
                <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">{{ $store->name }}</p>
                <span class="mt-1.5 inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 font-Inter text-xs font-semibold text-orange-600">
                    {{ $store->offers_count }} {{ $store->offers_count == 1 ? 'coupon' : 'coupons' }}
                </span>
            </a>
            @empty
            <div class="col-span-full text-center py-8">
                <p class="font-Inter text-gray-400">No trending stores yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>