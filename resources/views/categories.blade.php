<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse by Category</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    @include("pages-components.navbar")

    <section class="relative overflow-hidden bg-white py-14 sm:py-20">
        <div class="relative max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10 text-center">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3.5 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-red-600">
                <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                {{ $categories->count() }} Categories
            </span>

            <h1 class="mt-4 font-Manrope text-3xl sm:text-5xl font-extrabold text-gray-900 leading-tight">
                Every Category,
                <span class="relative inline-block text-red-600">
                    One Click Away
                </span>
            </h1>

            <p class="mx-auto mt-3 max-w-xl font-Inter text-sm sm:text-base text-gray-600">
                Search, filter, and save across every category on FavCoupons
            </p>

            <div class="mx-auto mt-7 flex max-w-xl items-center overflow-hidden rounded-full border border-gray-200 bg-white pl-6 pr-2 py-2 shadow-lg shadow-gray-100 focus-within:border-red-300 focus-within:ring-2 focus-within:ring-red-100 transition">
                <svg class="h-5 w-5 shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
                <input id="categorySearchInput" type="text" placeholder="Search categories..." class="w-full pl-3 bg-transparent outline-none font-Inter text-sm sm:text-base text-gray-900 placeholder:text-gray-400">
                <button type="button" class="cursor-pointer shrink-0 w-10 h-10 rounded-full bg-red-500 hover:bg-red-600 flex items-center justify-center transition">
                    <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
                </button>
            </div>

            <div class="mx-auto mt-9 flex max-w-md flex-wrap items-center justify-center divide-x divide-gray-200">
                <div class="flex-1 px-4">
                    <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">{{ $categories->count() }}</p>
                    <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Categories</p>
                </div>
                <div class="flex-1 px-4">
                    <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">{{ $totalStores }}</p>
                    <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Stores</p>
                </div>
                <div class="flex-1 px-4">
                    <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">{{ $totalCoupons }}</p>
                    <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Coupons</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 sm:py-16">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <p id="noCategoriesFound" class="hidden text-center font-Inter text-sm text-gray-500 py-10">No categories match your search.</p>

            <div id="categoryGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 sm:gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('coupons.category', $category) }}" data-name="{{ strtolower($category->name) }}" class="category-card group relative flex flex-col items-center gap-3 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                        <x-trending-badge :category="$category" />
                        <x-category-icon-badge :category="$category" />
                        <div>
                            <p class="font-Manrope text-sm sm:text-base font-bold text-gray-900">{{ $category->name }}</p>
                            <p class="mt-0.5 font-Inter text-xs text-gray-500">{{ $category->brands_count }} stores · {{ $category->offers_count }} coupons</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    @include("pages-components.footer")
</body>
</html>