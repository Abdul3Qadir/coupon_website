<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deals — Best Offers & Discounts</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter bg-gray-50">
    @include("pages-components.navbar")

    {{-- ===== HERO ===== --}}
    <section class="relative overflow-hidden bg-white py-10 sm:py-14 lg:py-20 border-b border-gray-100">
        <div class="deals-hero-blob deals-hero-blob--red"></div>
        <div class="deals-hero-blob deals-hero-blob--orange"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-8 lg:px-10 text-center">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1 sm:px-3.5 sm:py-1.5 font-Inter text-xs sm:text-sm font-semibold text-red-600 border border-red-100">
                <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 2c1 3 3 4.5 4.5 6.5 1.6 2.2 2 4.7 1.2 7A6.7 6.7 0 0112 20a6.7 6.7 0 01-7.2-4.5c-.7-2 0-4 1.4-5.6.2 1.4 1 2.3 2 2.6-.6-2.4.2-5 2.3-6.7.4 1.3 1.1 2 2 2.3-.3-2 .1-4 1-6.1z"/></svg>
                {{ $totalActiveDeals }} Live Deals
            </span>

            <h1 class="deals-hero-title mt-4 sm:mt-5 font-Manrope text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight tracking-tight">
                Deals That
                <span class="relative inline-block text-red-600">
                    Save You Money
                    <svg class="absolute -bottom-1 left-0 w-full" viewBox="0 0 200 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.00025 6.99997C25.7501 3.49999 83.2344 -3.10684 198 6.99997" stroke="#FECACA" stroke-width="3" stroke-linecap="round"/></svg>
                </span>
            </h1>

            <p class="deals-hero-subtitle mx-auto mt-3 sm:mt-4 max-w-lg font-Inter text-sm sm:text-base text-gray-500">
                No codes needed — just click and save. Hand-picked discounts from top brands, verified daily.
            </p>

            {{-- Search --}}
            <form method="GET" action="{{ route('deals') }}" class="mx-auto mt-6 sm:mt-8 flex max-w-xl items-center overflow-hidden rounded-full border border-gray-200 bg-white pl-4 sm:pl-5 pr-2 py-2 shadow-lg shadow-gray-100/60 focus-within:border-red-300 focus-within:ring-2 focus-within:ring-red-100 transition">
                <svg class="h-5 w-5 shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
                <input type="text" name="search" value="{{ $searchQuery }}" placeholder="Search deals by brand or keyword..." class="w-full pl-3 bg-transparent outline-none font-Inter text-sm sm:text-base text-gray-900 placeholder:text-gray-400 min-w-0">
                @if($searchQuery)
                    <a href="{{ route('deals', request()->except(['search', 'page'])) }}" id="dealsSearchClear" class="shrink-0 mr-2 p-1 rounded-full hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
                <button type="submit" class="cursor-pointer shrink-0 w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-red-600 hover:bg-red-700 flex items-center justify-center transition shadow-sm">
                    <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
                </button>
            </form>

            {{-- Stats --}}
            <div class="deals-hero-stats mx-auto mt-8 sm:mt-10 flex max-w-lg items-center justify-center divide-x divide-gray-200">
                <div class="flex-1 px-3 sm:px-4">
                    <p class="deals-hero-stat-number font-Manrope text-xl sm:text-2xl lg:text-3xl font-extrabold text-gray-900">{{ $totalActiveDeals }}</p>
                    <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Live Deals</p>
                </div>
                <div class="flex-1 px-3 sm:px-4">
                    <p class="deals-hero-stat-number font-Manrope text-xl sm:text-2xl lg:text-3xl font-extrabold text-red-600">{{ $endingToday }}</p>
                    <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Ending Today</p>
                </div>
                <div class="flex-1 px-3 sm:px-4">
                    <p class="deals-hero-stat-number font-Manrope text-xl sm:text-2xl lg:text-3xl font-extrabold text-gray-900">{{ $categories->count() }}</p>
                    <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Categories</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== STICKY FILTERS BAR ===== --}}
    <section class="deals-filter-bar">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-10">
            <div class="deals-filter-inner flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-3 py-3">

                {{-- Tabs --}}
                <div class="deals-filter-tabs flex items-center gap-1 bg-gray-100 rounded-full p-1 self-start sm:self-auto">
                    <a href="{{ route('deals', array_merge(request()->except(['tab', 'page']), ['tab' => 'active'])) }}"
                       class="deals-tab {{ $tab === 'active' ? 'deals-tab--active' : 'deals-tab--inactive' }}">
                        Active
                        <span class="deals-tab-badge {{ $tab === 'active' ? 'deals-tab-badge--active' : 'deals-tab-badge--inactive' }}">
                            {{ $totalActiveDeals }}
                        </span>
                    </a>
                    <a href="{{ route('deals', array_merge(request()->except(['tab', 'page']), ['tab' => 'expired'])) }}"
                       class="deals-tab {{ $tab === 'expired' ? 'deals-tab--active' : 'deals-tab--inactive' }}">
                        Expired
                        <span class="deals-tab-badge {{ $tab === 'expired' ? 'deals-tab-badge--active' : 'deals-tab-badge--inactive' }}">
                            {{ $totalExpiredDeals }}
                        </span>
                    </a>
                </div>

                {{-- Sort + Clear --}}
                <div class="deals-filter-actions flex items-center gap-2">
                    @if($searchQuery || $selectedCategory || $sort !== 'trending' || $tab !== 'active')
                        <a href="{{ route('deals') }}" class="shrink-0 inline-flex items-center gap-1 rounded-full bg-gray-100 hover:bg-gray-200 px-3 py-2 font-Inter text-xs font-semibold text-gray-600 transition">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            Clear
                        </a>
                    @endif

                    <div class="relative">
                        <select onchange="window.location.href = this.value"
                                class="deals-sort-select">
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'trending']) }}" {{ $sort === 'trending' ? 'selected' : '' }}>Trending</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ $sort === 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'ending']) }}" {{ $sort === 'ending' ? 'selected' : '' }}>Ending Soon</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'discount']) }}" {{ $sort === 'discount' ? 'selected' : '' }}>Best Discount</option>
                        </select>
                        <svg class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 h-3.5 w-3.5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>

            {{-- Category Pills — ALL in one scrollable row, hidden after 4 --}}
            <div class="deals-pills-row flex items-center gap-2 overflow-x-auto pb-3 deals-scrollbar-hide -mx-4 px-4 sm:mx-0 sm:px-0">
                <a href="{{ route('deals', request()->except(['category', 'page'])) }}"
                   class="deals-pill {{ !$selectedCategory ? 'deals-pill--active' : 'deals-pill--inactive' }}">
                    All Deals
                </a>

                @foreach($categories as $index => $category)
                    <a href="{{ route('deals', array_merge(request()->except(['category', 'page']), ['category' => $category->slug])) }}"
                       class="deals-pill {{ $selectedCategory === $category->slug ? 'deals-pill--active' : 'deals-pill--inactive' }} {{ $index >= 4 ? 'deals-cat-hidden' : '' }}"
                       data-cat-index="{{ $index }}">
                        {{ $category->name }}
                        @if($category->offers_count > 0)
                            <span class="deals-pill-badge {{ $selectedCategory === $category->slug ? 'deals-pill-badge--active' : 'deals-pill-badge--inactive' }}">
                                {{ $category->offers_count }}
                            </span>
                        @endif
                    </a>
                @endforeach

                @if($categories->count() > 4)
                    <button type="button" id="dealsShowAllCategories" data-count="{{ $categories->count() - 4 }}"
                            class="deals-pill deals-pill--inactive shrink-0 cursor-pointer border border-gray-300">
                        Show All ({{ $categories->count() - 4 }})+
                    </button>
                @endif
            </div>
        </div>
    </section>

    {{-- ===== TRENDING DEALS ===== --}}
    @if($tab === 'active' && $trendingDeals->count() > 0 && !$searchQuery && !$selectedCategory)
    <section class="py-8 sm:py-10 lg:py-14 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-10">
            <div class="flex items-center gap-2 mb-6 sm:mb-8">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-red-50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#dc2626" stroke-width="2" stroke-linejoin="round"><path d="M12 22C16.1421 22 19.5 18.6421 19.5 14.5C19.5 13.5 19.5 11.5 17.5 9C17.5 9 17.4004 11.8536 15.4262 11.4408C12.2331 10.7732 16.3551 4.50296 10.5 2C10.5 7 4.5 8.5 4.5 14.5C4.5 18.6421 7.85786 22 12 22Z"/><path d="M12 19.0011C13.933 19.0011 15.5 16.9864 15.5 14.5011C12.3 15.7011 11.1667 12.9379 11 11C9.55426 11.5532 8.5 13.8256 8.5 15C8.5 17.4853 10.067 19.0011 12 19.0011Z"/></svg>
                </span>
                <h2 class="font-Manrope text-lg sm:text-xl lg:text-2xl font-extrabold text-gray-900">Hot Right Now</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6">
                @foreach($trendingDeals as $deal)
                    @include('deals._card', ['deal' => $deal, 'isTrending' => true])
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ===== MAIN DEALS GRID ===== --}}
    <section class="py-8 sm:py-10 lg:py-14 {{ $tab === 'active' && $trendingDeals->count() > 0 && !$searchQuery && !$selectedCategory ? 'bg-gray-50' : 'bg-white' }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-10">

            <div class="flex items-center justify-between mb-6 sm:mb-8">
                <h2 class="font-Manrope text-lg sm:text-xl lg:text-2xl font-extrabold text-gray-900">
                    @if($tab === 'expired')
                        Expired Deals
                    @elseif($searchQuery)
                        Search Results
                    @elseif($selectedCategory)
                        {{ $categories->firstWhere('slug', $selectedCategory)?->name ?? 'Category' }} Deals
                    @else
                        All Active Deals
                    @endif
                    <span class="ml-2 text-sm font-semibold text-gray-400">({{ $deals->total() }})</span>
                </h2>
            </div>

            @if($deals->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                    @foreach($deals as $deal)
                        @include('deals._card', ['deal' => $deal, 'isTrending' => false])
                    @endforeach
                </div>

                @if($deals->hasPages())
                <div class="mt-10 sm:mt-12 flex flex-col items-center gap-4">
                    <div class="flex items-center gap-2">
                        @if($deals->onFirstPage())
                            <button type="button" disabled class="cursor-not-allowed inline-flex items-center gap-2 rounded-full bg-gray-100 border border-gray-200 px-4 sm:px-5 py-2 sm:py-2.5 font-Manrope text-sm font-semibold text-gray-400">
                                <svg class="h-4 w-4 rotate-180" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12l7 7 7-7"/></svg>
                                Previous
                            </button>
                        @else
                            <a href="{{ $deals->previousPageUrl() }}" class="inline-flex items-center gap-2 rounded-full bg-white border border-gray-200 hover:border-red-200 hover:bg-red-50 px-4 sm:px-5 py-2 sm:py-2.5 font-Manrope text-sm font-semibold text-gray-900 hover:text-red-600 shadow-sm transition">
                                <svg class="h-4 w-4 rotate-180" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12l7 7 7-7"/></svg>
                                Previous
                            </a>
                        @endif

                        <span class="font-Inter text-sm text-gray-500 px-2 sm:px-3">
                            Page {{ $deals->currentPage() }} of {{ $deals->lastPage() }}
                        </span>

                        @if($deals->hasMorePages())
                            <a href="{{ $deals->nextPageUrl() }}" class="inline-flex items-center gap-2 rounded-full bg-white border border-gray-200 hover:border-red-200 hover:bg-red-50 px-4 sm:px-5 py-2 sm:py-2.5 font-Manrope text-sm font-semibold text-gray-900 hover:text-red-600 shadow-sm transition">
                                Next
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12l7 7 7-7"/></svg>
                            </a>
                        @else
                            <button type="button" disabled class="cursor-not-allowed inline-flex items-center gap-2 rounded-full bg-gray-100 border border-gray-200 px-4 sm:px-5 py-2 sm:py-2.5 font-Manrope text-sm font-semibold text-gray-400">
                                Next
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12l7 7 7-7"/></svg>
                            </button>
                        @endif
                    </div>

                    <div class="deals-pagination-numbers hidden sm:flex items-center gap-1.5">
                        @foreach($deals->getUrlRange(1, $deals->lastPage()) as $page => $url)
                            @if($page == $deals->currentPage())
                                <span class="deals-page-btn deals-page-btn--current">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="deals-page-btn deals-page-btn--link">{{ $page }}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

            @else
                <div class="text-center py-16 sm:py-20 lg:py-28">
                    <div class="deals-empty-icon">
                        <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                        </svg>
                    </div>
                    <h3 class="font-Manrope text-lg sm:text-xl font-bold text-gray-900">
                        @if($searchQuery)
                            No deals match "{{ $searchQuery }}"
                        @elseif($selectedCategory)
                            No deals in this category
                        @elseif($tab === 'expired')
                            No expired deals yet
                        @else
                            No active deals right now
                        @endif
                    </h3>
                    <p class="mt-2 font-Inter text-sm text-gray-500 max-w-sm mx-auto">
                        @if($searchQuery || $selectedCategory)
                            Try adjusting your search or filters to find what you're looking for.
                        @else
                            Check back soon — new deals are added daily by our partner brands.
                        @endif
                    </p>
                    @if($searchQuery || $selectedCategory || $tab !== 'active')
                        <a href="{{ route('deals') }}" class="mt-5 sm:mt-6 inline-flex items-center gap-2 rounded-full bg-red-600 hover:bg-red-700 px-5 sm:px-6 py-2.5 sm:py-3 font-Manrope text-sm font-bold text-white shadow-sm transition">
                            View All Deals
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    @include("pages-components.footer")

</body>
</html>