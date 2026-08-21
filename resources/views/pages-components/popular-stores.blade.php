<section class="py-12">
    <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
        <div class="relative text-center">
            <h2 class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">Popular Stores</h2>
            <p class="mt-2 font-Inter text-sm sm:text-base text-gray-600">Most searched stores by our users</p>
            <a href="{{ route('stores.index') }}" class="hidden sm:inline-flex absolute right-0 top-3/4 -translate-y-1/2 items-center gap-1 font-Inter text-sm font-semibold text-red-600 hover:text-red-700">
                All Stores
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="mt-10 sm:mt-12 grid min-[320px]:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6">
            @forelse ($popularStores as $store)
            <a href="{{ route('stores.show', $store->slug) }}" class="group relative flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-amber-200">
                <span class="absolute -top-2 left-2 flex h-6 w-6 items-center justify-center rounded-full bg-amber-500 shadow-sm">
                    <svg class="h-3 w-3 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13.7276 3.44418L15.4874 6.99288C15.7274 7.48687 16.3673 7.9607 16.9073 8.05143L20.0969 8.58575C22.1367 8.92853 22.6167 10.4206 21.1468 11.8925L18.6671 14.3927C18.2471 14.8161 18.0172 15.6327 18.1471 16.2175L18.8571 19.3125C19.417 21.7623 18.1271 22.71 15.9774 21.4296L12.9877 19.6452C12.4478 19.3226 11.5579 19.3226 11.0079 19.6452L8.01827 21.4296C5.8785 22.71 4.57865 21.7522 5.13859 19.3125L5.84851 16.2175C5.97849 15.6327 5.74852 14.8161 5.32856 14.3927L2.84884 11.8925C1.389 10.4206 1.85895 8.92853 3.89872 8.58575L7.08837 8.05143C7.61831 7.9607 8.25824 7.48687 8.49821 6.99288L10.258 3.44418C11.2179 1.51861 12.7777 1.51861 13.7276 3.44418Z"/></svg>
                </span>
                <div class="flex h-16 w-full items-center justify-center rounded-xl">
                    @if($store->small_logo)
                        <img src="{{ asset('storage/' . $store->small_logo) }}" alt="{{ $store->name }}" class="max-h-18 min-[400px]:max-h-20 object-contain">
                    @else
                        <span class="font-Manrope text-sm font-bold text-gray-400">{{ $store->name }}</span>
                    @endif
                </div>
                <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">{{ $store->name }}</p>
                <span class="mt-1.5 rounded-full px-2.5 py-0.5 font-Inter text-xs font-semibold text-amber-600">{{ $store->offers_count }} {{ $store->offers_count == 1 ? 'coupon' : 'coupons' }}</span>
            </a>
            @empty
            <div class="col-span-full text-center py-8">
                <p class="font-Inter text-gray-400">No popular stores yet.</p>
            </div>
            @endforelse
        </div>

        <a href="{{ route('stores.index') }}" class="mt-8 flex sm:hidden items-center justify-center gap-1 font-Inter text-sm font-semibold text-red-600">
            All Stores
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
</section>