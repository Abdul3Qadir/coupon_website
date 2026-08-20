<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deals - Best Offers</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    @include("pages-components.navbar")

    <section class="relative overflow-hidden bg-white py-14 sm:py-16">
        <div class="relative max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10 text-center">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3.5 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-red-600">
                <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 2c1 3 3 4.5 4.5 6.5 1.6 2.2 2 4.7 1.2 7A6.7 6.7 0 0112 20a6.7 6.7 0 01-7.2-4.5c-.7-2 0-4 1.4-5.6.2 1.4 1 2.3 2 2.6-.6-2.4.2-5 2.3-6.7.4 1.3 1.1 2 2 2.3-.3-2 .1-4 1-6.1z"/></svg>
                {{ $totalActiveDeals }} Live Deals
            </span>

            <h1 class="mt-4 font-Manrope text-3xl sm:text-5xl font-extrabold text-gray-900 leading-tight">
                Deals That
                <span class="relative inline-block text-red-600">
                    Apply Themselves
                </span>
            </h1>

            <p class="mx-auto mt-3 max-w-xl font-Inter text-sm sm:text-base text-gray-600">
                No codes, no copy-paste just automatic savings at checkout
            </p>

            <form method="GET" class="mx-auto mt-7 flex max-w-xl items-center overflow-hidden rounded-full border border-gray-200 bg-white pl-6 pr-2 py-2 shadow-lg shadow-gray-100 focus-within:border-red-300 focus-within:ring-2 focus-within:ring-red-100 transition">
                <svg class="h-5 w-5 shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
                <input type="text" name="search" value="{{ $searchQuery }}" placeholder="Search deals or stores..." class="w-full pl-3 bg-transparent outline-none font-Inter text-sm sm:text-base text-gray-900 placeholder:text-gray-400">
                <button type="submit" class="cursor-pointer shrink-0 w-10 h-10 rounded-full bg-red-500 hover:bg-red-600 flex items-center justify-center transition">
                    <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
                </button>
            </form>

            <div class="mx-auto mt-9 flex max-w-md items-center justify-center divide-x divide-gray-200">
                <div class="flex-1 px-4">
                    <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">{{ $totalActiveDeals }}</p>
                    <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Live Deals</p>
                </div>
                <div class="flex-1 px-4">
                    <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">{{ $endingToday }}</p>
                    <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Ending Today</p>
                </div>
                <div class="flex-1 px-4">
                    <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">{{ $totalCategories }}</p>
                    <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Categories</p>
                </div>
            </div>
        </div>
    </section>

    @if($trendingDeals->count() > 0)
    <section class="py-10">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="flex items-center gap-2 mb-8">
                <span class="flex h-7 w-7 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linejoin="round"><path d="M12 22C16.1421 22 19.5 18.6421 19.5 14.5C19.5 13.5 19.5 11.5 17.5 9C17.5 9 17.4004 11.8536 15.4262 11.4408C12.2331 10.7732 16.3551 4.50296 10.5 2C10.5 7 4.5 8.5 4.5 14.5C4.5 18.6421 7.85786 22 12 22Z"/><path d="M12 19.0011C13.933 19.0011 15.5 16.9864 15.5 14.5011C12.3 15.7011 11.1667 12.9379 11 11C9.55426 11.5532 8.5 13.8256 8.5 15C8.5 17.4853 10.067 19.0011 12 19.0011Z"/></svg>
                </span>
                <h2 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">Hot Right Now</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($trendingDeals as $deal)
                <a href="/deals/{{ $deal->slug }}" class="group bg-white p-6 rounded-2xl border-2 border-red-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="relative flex items-center justify-between mb-5">
                        <div class="flex items-center justify-center rounded-xl bg-gray-100 p-2 border border-gray-200">
                            <img src="{{ $deal->brand->small_logo ?? '/images/brand-logos/zara.png' }}" alt="{{ $deal->brand->name }}" class="max-h-10 w-auto object-contain">
                        </div>
                        <span class="rounded-full bg-red-600 px-3 py-1 font-Manrope text-xs font-bold text-white">
                            @if($deal->discount_type->value === 'percentage')
                                {{ $deal->discount_value }}% OFF
                            @else
                                Rs. {{ $deal->discount_value }} OFF
                            @endif
                        </span>
                    </div>
                    <div class="grow">
                        <span class="inline-flex items-center gap-1 font-Inter text-[11px] font-bold uppercase tracking-wide text-red-600">
                            <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 2c1 3 3 4.5 4.5 6.5 1.6 2.2 2 4.7 1.2 7A6.7 6.7 0 0112 20a6.7 6.7 0 01-7.2-4.5c-.7-2 0-4 1.4-5.6.2 1.4 1 2.3 2 2.6-.6-2.4.2-5 2.3-6.7.4 1.3 1.1 2 2 2.3-.3-2 .1-4 1-6.1z"/></svg>
                            Trending ({{ $deal->clicks_count }} clicks)
                        </span>
                        @if($deal->category)
                        <span class="inline-block rounded-full bg-gray-100 px-2 py-0.5 font-Inter text-[10px] font-semibold text-gray-500">{{ $deal->category->name }}</span>
                        @endif
                        <h3 class="mt-1.5 font-Manrope text-lg font-bold text-gray-900 group-hover:text-red-600 transition-colors">{{ $deal->title }}</h3>
                        <p class="mt-2 text-xs sm:text-sm text-gray-600 leading-relaxed">{{ $deal->description }}</p>
                    </div>
                    <div class="mt-6 flex items-center justify-between pt-4 border-t border-gray-100">
                        <span class="inline-flex items-center gap-1 font-Inter text-xs font-medium text-red-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @if($deal->expires_at)
                                @php
                                    $daysLeft = now()->diffInDays($deal->expires_at);
                                @endphp
                                @if($daysLeft <= 0)
                                    Ends today
                                @else
                                    Ends in {{ $daysLeft }} day{{ $daysLeft !== 1 ? 's' : '' }}
                                @endif
                            @else
                                No expiry
                            @endif
                        </span>
                        <span class="inline-flex items-center gap-1 font-Manrope text-xs font-bold text-gray-900 group-hover:text-red-600 transition-colors">
                            Get Deal
                            <svg class="h-4 w-4 transform transition-transform group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="border-b border-gray-200 bg-white sticky top-0 z-20 pt-10">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="flex items-center gap-2.5 overflow-x-auto py-3 scrollbar-hide">
                <a href="/deals" class="shrink-0 rounded-full @if(!$selectedCategory) bg-red-600 text-white @else bg-gray-100 text-gray-800 hover:bg-gray-200 @endif px-4 py-2 font-Manrope text-sm font-semibold transition">All Deals</a>
                
                @foreach($categories->take(3) as $category)
                    <a href="/deals?category={{ $category->slug }}" class="shrink-0 rounded-full @if($selectedCategory === $category->slug) bg-red-600 text-white @else bg-gray-100 text-gray-800 hover:bg-gray-200 @endif px-4 py-2 font-Manrope text-sm font-semibold transition">{{ $category->name }}</a>
                @endforeach

                @if($categories->count() > 3)
                    <button type="button" id="showAllCategories" class="shrink-0 rounded-full bg-gray-100 text-gray-800 hover:bg-gray-200 px-4 py-2 font-Manrope text-sm font-semibold transition">
                        +{{ $categories->count() - 3 }} More
                    </button>

                    <div id="categoriesModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
                        <div class="bg-white rounded-2xl p-6 max-w-md w-full max-h-[80vh] overflow-y-auto">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-Manrope text-lg font-bold">All Categories</h3>
                                <button type="button" id="closeCategoriesModal" class="text-gray-400 hover:text-gray-600">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                                </button>
                            </div>
                            <div class="flex flex-col gap-2">
                                @foreach($categories as $category)
                                    <a href="/deals?category={{ $category->slug }}" class="p-3 rounded-lg hover:bg-gray-100 transition font-Inter text-sm text-gray-700">
                                        {{ $category->name }} <span class="text-gray-400">({{ $category->offers_count }})</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="py-10" id="dealsSection">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            @if($activeDeals->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500 font-Inter">No deals found matching your search.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    @foreach($activeDeals as $deal)
                    <a href="/deals/{{ $deal->slug }}" class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                        <div class="relative flex items-center justify-between mb-5">
                            <div class="flex items-center justify-center rounded-xl bg-gray-100 p-2 border border-gray-200">
                                <img src="{{ $deal->brand->small_logo ?? '/images/brand-logos/zara.png' }}" alt="{{ $deal->brand->name }}" class="max-h-10 w-auto object-contain">
                            </div>
                            <span class="rounded-full bg-red-600 px-3 py-1 font-Manrope text-xs font-bold text-white">
                                @if($deal->discount_type->value === 'percentage')
                                    {{ $deal->discount_value }}% OFF
                                @else
                                    Rs. {{ $deal->discount_value }} OFF
                                @endif
                            </span>
                        </div>
                        <div class="grow">
                            @if($deal->category)
                            <span class="inline-block rounded-full bg-gray-100 px-2 py-0.5 font-Inter text-[10px] font-semibold text-gray-500">{{ $deal->category->name }}</span>
                            @endif
                            <h3 class="mt-1.5 font-Manrope text-lg font-bold text-gray-900 group-hover:text-red-600 transition-colors">{{ $deal->title }}</h3>
                            <p class="mt-2 text-xs sm:text-sm text-gray-600 leading-relaxed">{{ $deal->description }}</p>
                        </div>
                        <div class="mt-6 flex items-center justify-between pt-4 border-t border-gray-100">
                            <span class="inline-flex items-center gap-1 font-Inter text-xs font-medium text-red-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                @if($deal->expires_at)
                                    @php
                                        $daysLeft = now()->diffInDays($deal->expires_at);
                                    @endphp
                                    @if($daysLeft <= 0)
                                        Ends today
                                    @else
                                        Ends in {{ $daysLeft }} day{{ $daysLeft !== 1 ? 's' : '' }}
                                    @endif
                                @else
                                    No expiry
                                @endif
                            </span>
                            <span class="inline-flex items-center gap-1 font-Manrope text-xs font-bold text-gray-900 group-hover:text-red-600 transition-colors">
                                Get Deal
                                <svg class="h-4 w-4 transform transition-transform group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </div>
                    </a>
                    @endforeach
                </div>

                @if($activeDeals->hasPages())
                <div class="flex flex-col items-center gap-3">
                    <div class="flex gap-2">
                        @if($activeDeals->onFirstPage())
                            <button type="button" disabled class="cursor-not-allowed inline-flex items-center gap-2 rounded-full bg-gray-100 border border-gray-200 px-6 py-3 font-Manrope text-sm font-semibold text-gray-400 shadow-sm">
                                <svg class="h-4 w-4 rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
                                Previous
                            </button>
                        @else
                            <a href="{{ $activeDeals->previousPageUrl() }}" class="cursor-pointer inline-flex items-center gap-2 rounded-full bg-white border border-gray-200 hover:border-red-200 hover:bg-red-50 px-6 py-3 font-Manrope text-sm font-semibold text-gray-900 hover:text-red-600 shadow-sm transition">
                                <svg class="h-4 w-4 rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
                                Previous
                            </a>
                        @endif

                        @if($activeDeals->hasMorePages())
                            <a href="{{ $activeDeals->nextPageUrl() }}" class="cursor-pointer inline-flex items-center gap-2 rounded-full bg-white border border-gray-200 hover:border-red-200 hover:bg-red-50 px-6 py-3 font-Manrope text-sm font-semibold text-gray-900 hover:text-red-600 shadow-sm transition">
                                Load More Deals
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
                            </a>
                        @else
                            <button type="button" disabled class="cursor-not-allowed inline-flex items-center gap-2 rounded-full bg-gray-100 border border-gray-200 px-6 py-3 font-Manrope text-sm font-semibold text-gray-400 shadow-sm">
                                Load More Deals
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
                            </button>
                        @endif
                    </div>
                </div>
                @endif
            @endif
        </div>
    </section>

    @if($expiredDeals->count() > 0)
    <section class="py-10 bg-gray-50">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <h3 class="font-Manrope text-xl font-bold text-gray-900 mb-6">Expired Deals</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($expiredDeals as $expiredDeal)
                <a href="#" class="group bg-white p-6 rounded-2xl border border-gray-100 shadow-sm opacity-60 flex flex-col">
                    <div class="relative flex items-center justify-between mb-5">
                        <div class="flex items-center justify-center rounded-xl bg-gray-100 p-2 border border-gray-200">
                            <img src="{{ $expiredDeal->brand->small_logo ?? '/images/brand-logos/zara.png' }}" alt="{{ $expiredDeal->brand->name }}" class="max-h-10 w-auto object-contain grayscale">
                        </div>
                        <span class="rounded-full bg-gray-200 px-3 py-1 font-Manrope text-xs font-bold text-gray-600">Expired</span>
                    </div>
                    <div class="grow">
                        @if($expiredDeal->category)
                        <span class="inline-block rounded-full bg-gray-100 px-2 py-0.5 font-Inter text-[10px] font-semibold text-gray-500">{{ $expiredDeal->category->name }}</span>
                        @endif
                        <h3 class="mt-2 font-Manrope text-lg font-bold text-gray-500">{{ $expiredDeal->title }}</h3>
                        <p class="mt-2 text-xs sm:text-sm text-gray-500 leading-relaxed">{{ $expiredDeal->description }}</p>
                    </div>
                    <div class="mt-6 flex items-center justify-between pt-4 border-t border-gray-100">
                        <span class="inline-flex items-center gap-1 font-Inter text-xs font-medium text-gray-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Expired
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @include("pages-components.footer")

    <script>
        document.getElementById('showAllCategories')?.addEventListener('click', () => {
            document.getElementById('categoriesModal').classList.remove('hidden');
        });

        document.getElementById('closeCategoriesModal')?.addEventListener('click', () => {
            document.getElementById('categoriesModal').classList.add('hidden');
        });

        document.getElementById('categoriesModal')?.addEventListener('click', (e) => {
            if (e.target === document.getElementById('categoriesModal')) {
                document.getElementById('categoriesModal').classList.add('hidden');
            }
        });
    </script>

    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
</body>
</html>