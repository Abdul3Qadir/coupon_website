<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stores Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    @include("pages-components.navbar")

    <section class="relative overflow-hidden bg-white py-14">
            <div class="relative max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10 text-center">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3.5 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-red-600">
                    <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.9 6.3L21.5 9l-5 4.6L17.8 21 12 17.6 6.2 21l1.3-7.4-5-4.6 6.6-.7z"/></svg>
                    1,240 Verified Stores
                </span>

                <h1 class="mt-4 font-Manrope text-3xl sm:text-5xl font-extrabold text-gray-900 leading-tight">
                    Every Store,
                    <span class="relative inline-block text-red-600">
                        Every Deal
                    </span>
                </h1>

                <p class="mx-auto mt-3 max-w-xl font-Inter text-sm sm:text-base text-gray-600">
                    Search, filter, and save across every store on Dumdaar Coupons
                </p>

                <div class="mx-auto mt-7 flex max-w-xl items-center overflow-hidden rounded-full border border-gray-200 bg-white pl-6 pr-2 py-2 shadow-lg shadow-gray-100 focus-within:border-red-300 focus-within:ring-2 focus-within:ring-red-100 transition">
                    <svg class="h-5 w-5 shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
                    <input type="text" placeholder="Search stores..." class="w-full pl-3 bg-transparent outline-none font-Inter text-sm sm:text-base text-gray-900 placeholder:text-gray-400">
                    <button type="button" class="cursor-pointer shrink-0 w-10 h-10 rounded-full bg-red-500 hover:bg-red-600 flex items-center justify-center transition">
                        <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/></svg>
                    </button>
                </div>

                <div class="mx-auto mt-9 flex max-w-md items-center justify-center divide-x divide-gray-200">
                    <div class="flex-1 px-4">
                        <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">1,240</p>
                        <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Stores</p>
                    </div>
                    <div class="flex-1 px-4">
                        <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">18,500+</p>
                        <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Coupons</p>
                    </div>
                    <div class="flex-1 px-4">
                        <p class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">24</p>
                        <p class="mt-0.5 font-Inter text-xs sm:text-sm text-gray-500">Categories</p>
                    </div>
                </div>
            </div>
    </section>

    <section class="border-b border-gray-200 bg-white sticky top-0 z-20">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="flex items-center gap-1.5 overflow-x-auto py-3 no-scrollbar">
                <a href="#" class="shrink-0 rounded-full bg-red-600 px-3.5 py-1.5 font-Inter text-xs sm:text-sm font-bold text-white">All</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">A</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">B</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">C</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">D</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">E</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">F</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">G</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">H</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">I</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">J</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">K</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">L</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">M</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">N</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">O</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">P</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">Q</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">R</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">S</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">T</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">U</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">V</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">W</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">X</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">Y</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">Z</a>
                <a href="#" class="shrink-0 rounded-full px-3 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition">#</a>
            </div>
        </div>
    </section>

    <section class="pt-8 sm:pt-10 pb-5 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="flex items-center gap-2.5 overflow-x-auto no-scrollbar">
                <button type="button" data-category="all" class="category-filter-btn cursor-pointer active shrink-0 rounded-full bg-gray-900 px-4 py-2 font-Manrope text-sm font-semibold text-white transition">All Categories</button>
                <button type="button" data-category="fashion" class="category-filter-btn cursor-pointer shrink-0 rounded-full bg-gray-100 px-4 py-2 font-Manrope text-sm font-semibold text-gray-800 transition">Fashion</button>
                <button type="button" data-category="beauty" class="category-filter-btn cursor-pointer shrink-0 rounded-full bg-gray-100 px-4 py-2 font-Manrope text-sm font-semibold text-gray-800 transition">Beauty</button>
                <button type="button" data-category="travel" class="category-filter-btn cursor-pointer shrink-0 rounded-full bg-gray-100 px-4 py-2 font-Manrope text-sm font-semibold text-gray-800 transition">Travel</button>
                <button type="button" data-category="hosting" class="category-filter-btn cursor-pointer shrink-0 rounded-full bg-gray-100 px-4 py-2 font-Manrope text-sm font-semibold text-gray-800 transition">Web Hosting</button>
                <button type="button" data-category="home" class="category-filter-btn cursor-pointer shrink-0 rounded-full bg-gray-100 px-4 py-2 font-Manrope text-sm font-semibold text-gray-800 transition">Home &amp; Living</button>
                <button type="button" data-category="electronics" class="category-filter-btn cursor-pointer shrink-0 rounded-full bg-gray-100 px-4 py-2 font-Manrope text-sm font-semibold text-gray-800 transition">Electronics</button>
            </div>

            <div class="flex items-center justify-between gap-4 mt-10 flex-col min-[500px]:flex-row border-t border-gray-100 pt-5">
                <h2 id="storesHeading" class="font-Inter text-lg sm:text-2xl font-bold text-gray-900 shrink-0 min-[500px]:self-auto">All Stores</h2>
                <div class="w-full min-[500px]:w-auto overflow-x-auto no-scrollbar">
                    <div class="flex items-center gap-1 shrink-0">
                        <button type="button" data-tab="all" class="store-tab-btn cursor-pointer active shrink-0 rounded-full bg-gray-900 px-4 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-white transition">All</button>
                        <button type="button" data-tab="trending" class="store-tab-btn cursor-pointer shrink-0 rounded-full px-4 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 transition">Trending</button>
                        <button type="button" data-tab="popular" class="store-tab-btn cursor-pointer shrink-0 rounded-full px-4 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 transition">Popular</button>
                        <button type="button" data-tab="new" class="store-tab-btn cursor-pointer shrink-0 rounded-full px-4 py-1.5 font-Inter text-xs sm:text-sm font-semibold text-gray-500 transition">New</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <p id="noStoresFound" class="hidden text-center font-Inter text-sm text-gray-500 py-14">No stores match this filter.</p>

            <div id="storesGrid" class="grid min-[380px]:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6">
                <a href="#" data-category="fashion" data-tab="all trending popular" class="store-card group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/zara.png" alt="Zara" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Zara</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Fashion</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">19 coupons</span>
                </a>

                <a href="#" data-category="home" data-tab="all popular" class="store-card group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/ikea.png" alt="Ikea" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Ikea</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Home &amp; Living</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">35 coupons</span>
                </a>

                <a href="#" data-category="hosting" data-tab="all trending" class="store-card group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/hostinger.png" alt="Hostinger" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Hostinger</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Web Hosting</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">27 coupons</span>
                </a>

                <a href="#" data-category="fashion" data-tab="all popular" class="store-card group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/zara.png" alt="Zara" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Zara</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Fashion</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">38 coupons</span>
                </a>

                <a href="#" data-category="home" data-tab="all new" class="store-card group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/ikea.png" alt="Ikea" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Ikea</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Home &amp; Living</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">12 coupons</span>
                </a>

                <a href="#" data-category="hosting" data-tab="all new" class="store-card group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/hostinger.png" alt="Hostinger" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Hostinger</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Web Hosting</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">9 coupons</span>
                </a>

                <a href="#" data-category="fashion" data-tab="all new" class="store-card group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/zara.png" alt="Zara" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Zara</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Fashion</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">7 coupons</span>
                </a>

                <a href="#" data-category="home" data-tab="all trending" class="store-card group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/ikea.png" alt="Ikea" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Ikea</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Home &amp; Living</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">25 coupons</span>
                </a>

                <a href="#" data-category="hosting" data-tab="all popular" class="store-card group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/hostinger.png" alt="Hostinger" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Hostinger</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Web Hosting</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">14 coupons</span>
                </a>

                <a href="#" data-category="fashion" data-tab="all trending new" class="store-card group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/zara.png" alt="Zara" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Zara</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Fashion</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">21 coupons</span>
                </a>
            </div>

            <div class="mt-10 sm:mt-12 flex flex-col items-center gap-3">
                <p class="font-Inter text-sm text-gray-500">Showing 10 of 1,240 stores</p>
                <button type="button" class="cursor-pointer inline-flex items-center gap-2 rounded-full bg-white border border-gray-200 hover:border-red-200 hover:bg-red-50 px-6 py-3 font-Manrope text-sm font-semibold text-gray-900 hover:text-red-600 shadow-sm transition">
                    Load More Stores
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
                </button>
            </div>
        </div>
    </section>

    @include("pages-components.footer")
</body>
</html>