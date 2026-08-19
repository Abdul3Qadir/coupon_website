<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stores</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    @include("pages-components.navbar")

    <section class="relative overflow-hidden bg-white py-14">
        <div class="relative max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10 text-center">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3.5 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-red-600">
                <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.9 6.3L21.5 9l-5 4.6L17.8 21 12 17.6 6.2 21l1.3-7.4-5-4.6 6.6-.7z"/></svg>
                {{ $totalStores }} Verified Stores
            </span>

            <h1 class="mt-4 font-Manrope text-3xl sm:text-5xl font-extrabold text-gray-900 leading-tight">
                Every Store,
                <span class="relative inline-block text-red-600">
                    Every Deal
                </span>
            </h1>

            <p class="mx-auto mt-3 max-w-xl font-Inter text-sm sm:text-base text-gray-600">
                Search, filter, and save across every store on Coupono
            </p>

            <form method="GET" action="#stores-section" class="mx-auto mt-7 flex max-w-xl items-center overflow-hidden rounded-full border border-gray-200 bg-white pl-6 pr-2 py-2 shadow-lg shadow-gray-100 focus-within:border-red-300 focus-within:ring-2 focus-within:ring-red-100 transition">
                <input type="hidden" name="letter" value="{{ $activeLetter }}">
                <input type="hidden" name="category" value="{{ $activeCategorySlug }}">
                <input type="hidden" name="tab" value="{{ $activeTab }}">
                <svg class="h-5 w-5 shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
                <input type="text" name="q" value="{{ $search }}" placeholder="Search stores..." class="w-full pl-3 bg-transparent outline-none font-Inter text-sm sm:text-base text-gray-900 placeholder:text-gray-400">
                <button type="submit" class="cursor-pointer shrink-0 w-10 h-10 rounded-full bg-red-500 hover:bg-red-600 flex items-center justify-center transition">
                    <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
                </button>
            </form>

            <div class="mx-auto mt-9 flex-wrap flex max-w-md items-center justify-center divide-x divide-gray-200">
                <div class="flex-1 px-4">
                    <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">{{ $totalStores }}</p>
                    <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Stores</p>
                </div>
                <div class="flex-1 px-4">
                    <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">{{ $totalCoupons }}</p>
                    <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Coupons</p>
                </div>
                <div class="flex-1 px-4">
                    <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">{{ $categories->count() }}</p>
                    <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Categories</p>
                </div>
            </div>
        </div>
    </section>

    @php
        $letters = array_merge(['all'], range('A', 'Z'), ['#']);

        $currentParams = [
            'q' => $search,
            'category' => $activeCategorySlug,
            'tab' => $activeTab,
        ];

        $visibleCategories = $categories->take(4);
        $remainingCategories = $categories->skip(4);
    @endphp

    {{-- Letters --}}
    <section class="border-b border-gray-200 bg-white sticky top-0 z-20">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="flex items-center gap-1.5 overflow-x-auto py-3 scrollbar-hide">

                @foreach ($letters as $letter)

                    @php
                        $isActive = $activeLetter === $letter;
                        $isEnabled = $letter === 'all' || in_array($letter, $activeLetters);
                    @endphp

                    @if ($isEnabled)

                        <a href="{{ request()->fullUrlWithQuery(array_merge($currentParams, ['letter' => $letter])) }}#stores-section"
                        @class([
                            'shrink-0 rounded-full px-3.5 py-1.5 font-Inter text-xs sm:text-sm font-bold transition',
                            'bg-red-600 text-white' => $isActive,
                            'text-gray-500 hover:bg-gray-100 hover:text-gray-900' => !$isActive,
                        ])>
                            {{ $letter === 'all' ? 'All' : $letter }}
                        </a>

                    @else

                        <span class="shrink-0 rounded-full px-3.5 py-1.5 font-Inter text-xs sm:text-sm font-bold text-gray-300 opacity-50 cursor-not-allowed">
                            {{ $letter === 'all' ? 'All' : $letter }}
                        </span>

                    @endif

                @endforeach

            </div>
        </div>
    </section>

    <section class="py-8 sm:py-10 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">

            @php
                $visibleCategories = $categories->take(4);
                $remainingCategories = $categories->skip(4);
            @endphp

            <div class="flex items-center gap-2.5 overflow-x-auto scrollbar-hide">
                {{-- All Categories --}}
                <a href="{{ request()->fullUrlWithQuery([
                    'category' => 'all',
                    'letter' => $activeLetter,
                    'tab' => $activeTab,
                    'q' => $search
                ]) }}#stores-section"
                class="shrink-0 rounded-full px-4 py-2 font-Manrope text-sm font-semibold
                        {{ $activeCategorySlug === 'all'
                                ? 'bg-gray-900 text-white'
                                : 'bg-gray-50 text-gray-800 hover:bg-gray-900 hover:text-white' }}">
                    All Categories
                </a>


                {{-- First 4 Categories --}}
                @foreach ($visibleCategories as $category)

                    <a href="{{ request()->fullUrlWithQuery([
                        'category' => $category->slug,
                        'letter' => $activeLetter,
                        'tab' => $activeTab,
                        'q' => $search
                    ]) }}#stores-section"
                    class="shrink-0 rounded-full px-4 py-2 font-Manrope text-sm font-semibold
                            {{ $activeCategorySlug === $category->slug
                                    ? 'bg-gray-900 text-white'
                                    : 'bg-gray-50 text-gray-800 hover:bg-gray-900 hover:text-white' }}">
                        {{ $category->name }}
                    </a>

                @endforeach


                {{-- Remaining Categories --}}
                @if ($remainingCategories->count() > 0)

                    <div id="remainingCategories"
                        class="flex items-center gap-2.5 shrink-0
                                overflow-hidden transition-all duration-500 ease-in-out"
                        style="max-width: 0; opacity: 0;">

                        @foreach ($remainingCategories as $category)

                            <a href="{{ request()->fullUrlWithQuery([
                                'category' => $category->slug,
                                'letter' => $activeLetter,
                                'tab' => $activeTab,
                                'q' => $search
                            ]) }}#stores-section"
                            class="shrink-0 rounded-full px-4 py-2 font-Manrope text-sm font-semibold
                                    {{ $activeCategorySlug === $category->slug
                                            ? 'bg-gray-900 text-white'
                                            : 'bg-gray-50 text-gray-800 hover:bg-gray-900 hover:text-white' }}">
                                {{ $category->name }}
                            </a>

                        @endforeach

                    </div>

                    <button type="button" id="showCategoriesBtn" data-count="{{ $remainingCategories->count() }}"
                        class="shrink-0 rounded-full px-4 py-2 bg-gray-50 cursor-pointer border border-gray-800 text-gray-800 hover:bg-gray-900 hover:text-white font-Manrope text-sm font-semibold transition-all duration-300">
                        Show All ({{ $remainingCategories->count() }})+
                    </button>

                @endif

            </div>


            <div class="relative mt-10 border-t border-gray-100 pt-5">
                <div class="flex items-center justify-between gap-4">
                    <h2 id="storesHeading" class="shrink-0 whitespace-nowrap font-Inter text-lg font-bold text-gray-900 sm:text-2xl">
                        All Stores
                    </h2>

                    <div class="relative shrink-0">
                        <button type="button" id="storeTabDropdownBtn" class="group flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 font-Inter text-xs font-semibold text-gray-700 shadow-sm transition-all duration-200 hover:border-gray-300 hover:shadow-md sm:text-sm">
                            <span id="storeTabDropdownLabel">
                                {{ ['all' => 'All', 'trending' => 'Trending', 'popular' => 'Popular', 'new' => 'New'][$activeTab] ?? 'All' }}
                            </span>
                            <svg id="storeTabDropdownIcon" class="h-4 w-4 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                            </svg>
                        </button>

                        <div id="storeTabDropdown" class="invisible absolute right-0 top-full z-50 mt-2 w-44 origin-top-right translate-y-1 scale-95 rounded-2xl border border-gray-100 bg-white p-1.5 opacity-0 shadow-xl shadow-gray-200/60 transition-all duration-200">
                            @foreach (['all' => 'All', 'trending' => 'Trending', 'popular' => 'Popular', 'new' => 'New'] as $key => $label)
                                <a href="{{ request()->fullUrlWithQuery(['tab' => $key, 'letter' => $activeLetter, 'category' => $activeCategorySlug, 'q' => $search]) }}#stores-section"
                                class="flex items-center justify-between rounded-xl px-2 py-1 font-Inter text-sm font-medium transition-all duration-200 {{ $activeTab === $key ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <span>{{ $label }}</span>
                                    @if ($activeTab === $key)
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                                        </svg>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="stores-section" class="py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div id="storesGrid" class="grid min-[380px]:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6">
                @include("stores._cards")
            </div>

            <div class="mt-10 sm:mt-12 flex flex-col items-center gap-3">
                <p class="font-Inter text-sm text-gray-500">Showing {{ $stores->count() }} of {{ $stores->total() }} stores</p>
                @if ($stores->hasMorePages())
                    <button type="button" id="loadMoreStoresBtn" data-next-url="{{ $stores->nextPageUrl() }}" class="cursor-pointer inline-flex items-center gap-2 rounded-full bg-white border border-gray-200 hover:border-red-200 hover:bg-red-50 px-6 py-3 font-Manrope text-sm font-semibold text-gray-900 hover:text-red-600 shadow-sm transition">
                        Load More Stores
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
                    </button>
                @endif
            </div>
        </div>
    </section>

    @include("pages-components.footer")
</body>
</html>