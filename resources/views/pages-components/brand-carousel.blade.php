<section class="bg-white py-16 overflow-hidden">
    <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10 text-center">
        <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3.5 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-red-600">
            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l2.9 6.3L21.5 9l-5 4.6L17.8 21 12 17.6 6.2 21l1.3-7.4-5-4.6 6.6-.7z"/>
            </svg>
            Trusted by {{ $totalStores }}+ Stores
        </span>
 
        <h2 class="mt-4 font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">
            Explore Deals From
            <span class="relative inline-block text-red-600">
                Top Brands
                <svg class="absolute left-0 -bottom-1 w-full" viewBox="0 0 200 10" preserveAspectRatio="none" fill="none">
                    <path d="M2 7C40 2 160 2 198 7" stroke="#fca5a5" stroke-width="4" stroke-linecap="round"/>
                </svg>
            </span>
        </h2>
 
        <p class="mx-auto mt-3 max-w-xl font-Inter text-sm sm:text-base text-gray-600">
            Handpicked coupons from the stores you already love, refreshed every day.
        </p>
    </div>

    <div class="relative mt-10 sm:mt-14">
        <div class="pointer-events-none absolute inset-y-0 left-0 w-16 sm:w-32 bg-linear-to-r from-white to-transparent z-10"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 w-16 sm:w-32 bg-linear-to-l from-white to-transparent z-10"></div>

        @if($carouselBrands->isNotEmpty())
        <div class="brand-carousel overflow-hidden">
            <div class="brand-carousel-track flex items-center w-max">
                <div class="brand-carousel-group flex items-center gap-10 pr-10 sm:pr-16 shrink-0">
                    @foreach($carouselBrands as $brand)
                    <div class="flex items-center justify-center h-14 sm:h-18 shrink-0">
                        <img src="{{ $brand->small_logo ? asset('storage/' . $brand->small_logo) : '/images/brand-logos/default.png' }}" alt="{{ $brand->name }}" class="max-h-full max-w-full w-auto h-auto object-contain transition">
                    </div>
                    @endforeach
                    {{-- Duplicate for infinite scroll effect --}}
                    @foreach($carouselBrands as $brand)
                    <div class="flex items-center justify-center h-14 sm:h-18 shrink-0">
                        <img src="{{ $brand->small_logo ? asset('storage/' . $brand->small_logo) : '/images/brand-logos/default.png' }}" alt="{{ $brand->name }}" class="max-h-full max-w-full w-auto h-auto object-contain transition">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <p class="text-center text-gray-400 font-Inter text-sm">No brands available yet</p>
        @endif
    </div>
</section>