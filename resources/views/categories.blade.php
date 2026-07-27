<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    @include("pages-components.navbar")

    <section class="relative overflow-hidden bg-white py-12">

    <div class="relative max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10 text-center">
        <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3.5 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-red-600">
            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
            24 Categories
        </span>

        <h1 class="mt-4 font-Manrope text-3xl sm:text-5xl font-extrabold text-gray-900 leading-tight">
            Every Category,
            <span class="relative inline-block text-red-600">
                One Click Away
            </span>
        </h1>

        <p class="mx-auto mt-3 max-w-xl font-Inter text-sm sm:text-base text-gray-600">
            Search, filter, and save across every category on Coupono
        </p>

        <div class="mx-auto mt-7 flex max-w-xl items-center overflow-hidden rounded-full border border-gray-200 bg-white pl-6 pr-2 py-2 shadow-lg shadow-gray-100 focus-within:border-red-300 focus-within:ring-2 focus-within:ring-red-100 transition">
            <svg class="h-5 w-5 shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
            <input id="categorySearchInput" type="text" placeholder="Search categories..." class="w-full pl-3 bg-transparent outline-none font-Inter text-sm sm:text-base text-gray-900 placeholder:text-gray-400">
            <button type="button" class="cursor-pointer shrink-0 w-10 h-10 rounded-full bg-red-500 hover:bg-red-600 flex items-center justify-center transition">
                <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
            </button>
        </div>

        <div class="mt-4 flex flex-wrap items-center justify-center gap-2 font-Inter text-xs sm:text-sm">
            <span class="text-gray-400">Popular:</span>
            <a href="#" class="cursor-pointer text-gray-600 hover:text-red-600 transition">Fashion</a>
            <span class="text-gray-300">·</span>
            <a href="#" class="cursor-pointer text-gray-600 hover:text-red-600 transition">Beauty</a>
            <span class="text-gray-300">·</span>
            <a href="#" class="cursor-pointer text-gray-600 hover:text-red-600 transition">Electronics</a>
            <span class="text-gray-300">·</span>
            <a href="#" class="cursor-pointer text-gray-600 hover:text-red-600 transition">Travel</a>
        </div>

        <div class="mx-auto mt-9 flex max-w-md items-center justify-center divide-x divide-gray-200">
            <div class="flex-1 px-4">
                <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">24</p>
                <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Categories</p>
            </div>
            <div class="flex-1 px-4">
                <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">1,240</p>
                <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Stores</p>
            </div>
            <div class="flex-1 px-4">
                <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">18,500+</p>
                <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Coupons</p>
            </div>
        </div>
    </div>
</section>

<section class="py-10 sm:py-16">
    <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
        <p id="noCategoriesFound" class="hidden text-center font-Inter text-sm text-gray-500 py-10">No categories match your search.</p>

        <div class="mb-10 sm:mb-14 text-center">
            <h2 class="mt-4 font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">
                Explore by Category
            </h2>

            <p class="mx-auto mt-3 max-w-2xl font-Inter text-sm sm:text-base text-gray-600 leading-relaxed">
                Discover verified coupons and exclusive deals across fashion, electronics, travel,
                beauty, software, food, and many more categories. All in one place.
            </p>
        </div>

        <div id="categoryGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 sm:gap-6">
            <a href="/coupons/category" data-name="fashion" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-rose-200">
                <span class="absolute top-3 right-3 inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-0.5 font-Inter text-[10px] font-bold text-red-600">
                    <svg class="h-2.5 w-2.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 2c1 3 3 4.5 4.5 6.5 1.6 2.2 2 4.7 1.2 7A6.7 6.7 0 0112 20a6.7 6.7 0 01-7.2-4.5c-.7-2 0-4 1.4-5.6.2 1.4 1 2.3 2 2.6-.6-2.4.2-5 2.3-6.7.4 1.3 1.1 2 2 2.3-.3-2 .1-4 1-6.1z"/></svg>
                    Trending
                </span>
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-rose-50">
                    <svg class="h-7 w-7 text-rose-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46L16 2a4 4 0 01-8 0L3.62 3.46a2 2 0 00-1.34 2.23l.58 3.47a1 1 0 00.99.84H6v10a2 2 0 002 2h8a2 2 0 002-2V10h2.15a1 1 0 00.99-.84l.58-3.47a2 2 0 00-1.34-2.23z"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Fashion</p>
                <p class="font-Inter text-xs text-gray-500">Clothing, shoes &amp; accessories</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-rose-600">522 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-rose-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="beauty" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-pink-200">
                <span class="absolute top-3 right-3 inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-0.5 font-Inter text-[10px] font-bold text-red-600">
                    <svg class="h-2.5 w-2.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 2c1 3 3 4.5 4.5 6.5 1.6 2.2 2 4.7 1.2 7A6.7 6.7 0 0112 20a6.7 6.7 0 01-7.2-4.5c-.7-2 0-4 1.4-5.6.2 1.4 1 2.3 2 2.6-.6-2.4.2-5 2.3-6.7.4 1.3 1.1 2 2 2.3-.3-2 .1-4 1-6.1z"/></svg>
                    Trending
                </span>
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-pink-50">
                    <svg class="h-7 w-7 text-pink-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l1.8 5.6L19 9l-5.2 1.4L12 16l-1.8-5.6L5 9l5.2-1.4z"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Beauty</p>
                <p class="font-Inter text-xs text-gray-500">Skincare, makeup &amp; haircare</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-pink-600">256 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-pink-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="travel" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-sky-200">
                <span class="absolute top-3 right-3 inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-0.5 font-Inter text-[10px] font-bold text-red-600">
                    <svg class="h-2.5 w-2.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 2c1 3 3 4.5 4.5 6.5 1.6 2.2 2 4.7 1.2 7A6.7 6.7 0 0112 20a6.7 6.7 0 01-7.2-4.5c-.7-2 0-4 1.4-5.6.2 1.4 1 2.3 2 2.6-.6-2.4.2-5 2.3-6.7.4 1.3 1.1 2 2 2.3-.3-2 .1-4 1-6.1z"/></svg>
                    Trending
                </span>
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-50">
                    <svg class="h-7 w-7 text-sky-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l18-8-8 18-2-8-8-2z"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Travel</p>
                <p class="font-Inter text-xs text-gray-500">Flights, hotels &amp; holidays</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-sky-600">247 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-sky-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="software" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-indigo-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50">
                    <svg class="h-7 w-7 text-indigo-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 4L2 12l6 8M16 4l6 8-6 8"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Software</p>
                <p class="font-Inter text-xs text-gray-500">Apps, tools &amp; subscriptions</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-indigo-600">233 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-indigo-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="home & living" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-amber-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-50">
                    <svg class="h-7 w-7 text-amber-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><path d="M9 22V12h6v10"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Home &amp; Living</p>
                <p class="font-Inter text-xs text-gray-500">Furniture, decor &amp; essentials</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-amber-600">230 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-amber-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="electronics" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-blue-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50">
                    <svg class="h-7 w-7 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Electronics</p>
                <p class="font-Inter text-xs text-gray-500">Gadgets, laptops &amp; accessories</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-blue-600">210 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-blue-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="health" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-50">
                    <svg class="h-7 w-7 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78L12 21l8.84-8.84a5.5 5.5 0 000-7.78z"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Health</p>
                <p class="font-Inter text-xs text-gray-500">Medicines, wellness &amp; fitness</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-red-600">205 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-red-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="web" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-teal-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-teal-50">
                    <svg class="h-7 w-7 text-teal-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15 15 0 010 20M12 2a15 15 0 000 20"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Web</p>
                <p class="font-Inter text-xs text-gray-500">Hosting, domains &amp; tools</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-teal-600">128 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-teal-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="hotels" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-purple-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-50">
                    <svg class="h-7 w-7 text-purple-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4v16M2 8h18a2 2 0 012 2v10M2 17h20"/><path d="M6 8V6a2 2 0 012-2h3a2 2 0 012 2v2"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Hotels</p>
                <p class="font-Inter text-xs text-gray-500">Stays, resorts &amp; bookings</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-purple-600">123 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-purple-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="western wear" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-orange-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-50">
                    <svg class="h-7 w-7 text-orange-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46L16 2a4 4 0 01-8 0L3.62 3.46a2 2 0 00-1.34 2.23l.58 3.47a1 1 0 00.99.84H6v10a2 2 0 002 2h8a2 2 0 002-2V10h2.15a1 1 0 00.99-.84l.58-3.47a2 2 0 00-1.34-2.23z"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Western Wear</p>
                <p class="font-Inter text-xs text-gray-500">Jeans, tops &amp; casual wear</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-orange-600">108 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-orange-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="skincare" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-fuchsia-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-fuchsia-50">
                    <svg class="h-7 w-7 text-fuchsia-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2s7 7.5 7 12a7 7 0 11-14 0c0-4.5 7-12 7-12z"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Skincare</p>
                <p class="font-Inter text-xs text-gray-500">Cleansers, serums &amp; sunscreens</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-fuchsia-600">105 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-fuchsia-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="food" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-lime-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-lime-50">
                    <svg class="h-7 w-7 text-lime-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v7a2 2 0 002 2h1v11h2V4h1v18h2V4c1.1 0 2-.9 2-2"/><path d="M17 2v20M17 2a4 4 0 00-4 4v4h4"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Food</p>
                <p class="font-Inter text-xs text-gray-500">Restaurants, delivery &amp; groceries</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-lime-600">97 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-lime-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="finance" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-emerald-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-50">
                    <svg class="h-7 w-7 text-emerald-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="14" rx="2"/><path d="M2 10h20"/><circle cx="16" cy="14" r="1"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Finance</p>
                <p class="font-Inter text-xs text-gray-500">Banking, insurance &amp; investing</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-emerald-600">78 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-emerald-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="saas" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-cyan-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-50">
                    <svg class="h-7 w-7 text-cyan-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.5 19a4.5 4.5 0 000-9 6 6 0 10-11.4 3A4 4 0 006 19h11.5z"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">SaaS</p>
                <p class="font-Inter text-xs text-gray-500">Business &amp; productivity software</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-cyan-600">78 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-cyan-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="education" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-yellow-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-yellow-50">
                    <svg class="h-7 w-7 text-yellow-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Education</p>
                <p class="font-Inter text-xs text-gray-500">Courses, books &amp; tutoring</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-yellow-600">77 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-yellow-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="supplements" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-green-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-green-50">
                    <svg class="h-7 w-7 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.5 20.5a4.95 4.95 0 01-7-7l7-7a4.95 4.95 0 117 7l-7 7z"/><path d="M8.5 8.5l7 7"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Supplements</p>
                <p class="font-Inter text-xs text-gray-500">Vitamins &amp; protein</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-green-600">74 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-green-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="hosting" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-violet-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-violet-50">
                    <svg class="h-7 w-7 text-violet-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="6" rx="1"/><rect x="2" y="13" width="20" height="6" rx="1"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="16" x2="6.01" y2="16"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Hosting</p>
                <p class="font-Inter text-xs text-gray-500">Web hosting &amp; domains</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-violet-600">72 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-violet-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="footwear" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-orange-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-50">
                    <svg class="h-7 w-7 text-orange-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 18h16a1 1 0 001-1c0-2-2-3-4-3.5-2-.5-3-1.5-3-3.5V7a3 3 0 00-3-3H8a1 1 0 00-1 1v3c0 2-3 3-3 7a1 1 0 001 1z"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Footwear</p>
                <p class="font-Inter text-xs text-gray-500">Sneakers, heels &amp; sandals</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-orange-600">63 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-orange-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="flights" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-sky-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-50">
                    <svg class="h-7 w-7 text-sky-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l18-8-8 18-2-8-8-2z"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Flights</p>
                <p class="font-Inter text-xs text-gray-500">Domestic &amp; international fares</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-sky-600">55 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-sky-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="wellness" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-teal-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-teal-50">
                    <svg class="h-7 w-7 text-teal-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 019.8 6.1C15.5 5 17 4.5 19 2c1 2 1 4-1 8-2 6-4 8-8 10z"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Wellness</p>
                <p class="font-Inter text-xs text-gray-500">Fitness, yoga &amp; self-care</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-teal-600">55 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-teal-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="entertainment" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-50">
                    <svg class="h-7 w-7 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M10 8l6 4-6 4z" fill="currentColor"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Entertainment</p>
                <p class="font-Inter text-xs text-gray-500">Movies, music &amp; streaming</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-red-600">53 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-red-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="productivity" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-blue-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50">
                    <svg class="h-7 w-7 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 12l2 2 4-4"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Productivity</p>
                <p class="font-Inter text-xs text-gray-500">Task tools &amp; workflow apps</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-blue-600">48 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-blue-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="furniture" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-amber-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-50">
                    <svg class="h-7 w-7 text-amber-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 13h16v6H4z"/><path d="M4 13V8a2 2 0 012-2h12a2 2 0 012 2v5M4 19v2M20 19v2"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Furniture</p>
                <p class="font-Inter text-xs text-gray-500">Sofas, tables &amp; storage</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-amber-600">44 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-amber-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <a href="#" data-name="gaming" class="category-card cursor-pointer group relative flex flex-col items-center gap-1 rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-purple-200">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-50">
                    <svg class="h-7 w-7 text-purple-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="12" rx="4"/><line x1="7" y1="11" x2="7" y2="15"/><line x1="5" y1="13" x2="9" y2="13"/><circle cx="16" cy="11" r="1"/><circle cx="18" cy="14" r="1"/></svg>
                </span>
                <p class="mt-2 font-Manrope text-sm sm:text-base font-bold text-gray-900">Gaming</p>
                <p class="font-Inter text-xs text-gray-500">Consoles, games &amp; accessories</p>
                <p class="mt-1 font-Inter text-xs font-semibold text-purple-600">38 coupons</p>
                <span class="mt-2 inline-flex items-center gap-1 font-Inter text-xs font-semibold text-gray-400 opacity-0 group-hover:opacity-100 group-hover:text-purple-600 transition">
                    Browse
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>
        </div>
    </div>
</section>

<section class="py-14">
    <div class="max-w-3xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
        <div class="text-center">
            <h2 class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">Frequently Asked Questions</h2>
            <p class="mt-2 font-Inter text-sm sm:text-base text-gray-600">Everything you need to know about using Coupono</p>
        </div>

        <div class="mt-10 sm:mt-12 divide-y divide-gray-200 border-t border-b border-gray-200">
            <div class="faq-item">
                <button type="button" class="faq-toggle cursor-pointer flex w-full items-center justify-between gap-4 py-5 text-left" aria-expanded="false">
                    <span class="font-Manrope text-sm sm:text-base font-semibold text-gray-900">Is Coupono free to use?</span>
                    <svg class="faq-icon h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div class="faq-panel grid overflow-hidden transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                    <div class="overflow-hidden">
                        <p class="pb-5 font-Inter text-sm text-gray-600">Yes, completely free. We never charge you for browsing stores or using coupon codes, and you don't need an account to use them.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-toggle cursor-pointer flex w-full items-center justify-between gap-4 py-5 text-left" aria-expanded="false">
                    <span class="font-Manrope text-sm sm:text-base font-semibold text-gray-900">How do I use a coupon code?</span>
                    <svg class="faq-icon h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div class="faq-panel grid overflow-hidden transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                    <div class="overflow-hidden">
                        <p class="pb-5 font-Inter text-sm text-gray-600">Copy the code from the coupon card, head to the store's website, add items to your cart, and paste the code in the promo or discount box at checkout.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-toggle cursor-pointer flex w-full items-center justify-between gap-4 py-5 text-left" aria-expanded="false">
                    <span class="font-Manrope text-sm sm:text-base font-semibold text-gray-900">Why isn't my coupon code working?</span>
                    <svg class="faq-icon h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div class="faq-panel grid overflow-hidden transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                    <div class="overflow-hidden">
                        <p class="pb-5 font-Inter text-sm text-gray-600">Codes can expire or hit their usage limit without notice, and some only work on specific products or minimum order values. Double-check the terms on the coupon card, and try another code from the same store if it fails.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-toggle cursor-pointer flex w-full items-center justify-between gap-4 py-5 text-left" aria-expanded="false">
                    <span class="font-Manrope text-sm sm:text-base font-semibold text-gray-900">How often are new coupons added?</span>
                    <svg class="faq-icon h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div class="faq-panel grid overflow-hidden transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                    <div class="overflow-hidden">
                        <p class="pb-5 font-Inter text-sm text-gray-600">Our team checks and refreshes coupons daily, and every store is rechecked at least once a week to remove expired codes.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-toggle cursor-pointer flex w-full items-center justify-between gap-4 py-5 text-left" aria-expanded="false">
                    <span class="font-Manrope text-sm sm:text-base font-semibold text-gray-900">Do you have coupons for Pakistani stores?</span>
                    <svg class="faq-icon h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div class="faq-panel grid overflow-hidden transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                    <div class="overflow-hidden">
                        <p class="pb-5 font-Inter text-sm text-gray-600">Yes, alongside popular international brands we focus heavily on local Pakistani stores across fashion, food, travel, and web services.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-toggle cursor-pointer flex w-full items-center justify-between gap-4 py-5 text-left" aria-expanded="false">
                    <span class="font-Manrope text-sm sm:text-base font-semibold text-gray-900">Can I submit a coupon code?</span>
                    <svg class="faq-icon h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div class="faq-panel grid overflow-hidden transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                    <div class="overflow-hidden">
                        <p class="pb-5 font-Inter text-sm text-gray-600">Absolutely, if you find a working code we don't have listed yet, you can submit it through the store page and our team will verify it before publishing.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-toggle cursor-pointer flex w-full items-center justify-between gap-4 py-5 text-left" aria-expanded="false">
                    <span class="font-Manrope text-sm sm:text-base font-semibold text-gray-900">Are the coupons verified?</span>
                    <svg class="faq-icon h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div class="faq-panel grid overflow-hidden transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                    <div class="overflow-hidden">
                        <p class="pb-5 font-Inter text-sm text-gray-600">Every coupon marked "Verified" has been manually tested by our team before it goes live, so you can trust it works at the time of publishing.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-toggle cursor-pointer flex w-full items-center justify-between gap-4 py-5 text-left" aria-expanded="false">
                    <span class="font-Manrope text-sm sm:text-base font-semibold text-gray-900">Do I need to create an account?</span>
                    <svg class="faq-icon h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div class="faq-panel grid overflow-hidden transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                    <div class="overflow-hidden">
                        <p class="pb-5 font-Inter text-sm text-gray-600">No, you can browse stores and copy coupon codes without signing up. Creating a free account only unlocks deal alerts and saved favorites.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-toggle cursor-pointer flex w-full items-center justify-between gap-4 py-5 text-left" aria-expanded="false">
                    <span class="font-Manrope text-sm sm:text-base font-semibold text-gray-900">What if a store isn't listed on Coupono?</span>
                    <svg class="faq-icon h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div class="faq-panel grid overflow-hidden transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                    <div class="overflow-hidden">
                        <p class="pb-5 font-Inter text-sm text-gray-600">We're adding new stores every week. Use the request form on our Stores page to let us know which one you'd like to see next.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-toggle cursor-pointer flex w-full items-center justify-between gap-4 py-5 text-left" aria-expanded="false">
                    <span class="font-Manrope text-sm sm:text-base font-semibold text-gray-900">Does Coupono share my data with stores?</span>
                    <svg class="faq-icon h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div class="faq-panel grid overflow-hidden transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                    <div class="overflow-hidden">
                        <p class="pb-5 font-Inter text-sm text-gray-600">No, we don't sell or share your personal data with the stores listed on our site. Clicking through to a store follows that store's own privacy policy from that point on.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    @include("pages-components.footer")
</body>
</html>