<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Coupons &amp; Deals</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    @include("pages-components.navbar")

    <section class="pt-10 sm:pt-14">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="flex items-center gap-1.5 font-Inter text-xs sm:text-sm text-gray-500 mb-5">
                <a href="#" class="hover:text-red-600 transition">Home</a>
                <span>/</span>
                <a href="#" class="hover:text-red-600 transition">Categories</a>
                <span>/</span>
                <span class="text-gray-900 font-semibold">Fashion</span>
            </div>

            <div class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-rose-50">
                    <svg class="h-6 w-6 text-rose-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46L16 2a4 4 0 01-8 0L3.62 3.46a2 2 0 00-1.34 2.23l.58 3.47a1 1 0 00.99.84H6v10a2 2 0 002 2h8a2 2 0 002-2V10h2.15a1 1 0 00.99-.84l.58-3.47a2 2 0 00-1.34-2.23z"/></svg>
                </span>
                <h1 class="font-Manrope text-2xl sm:text-4xl font-extrabold text-gray-900">Fashion Coupons &amp; Deals</h1>
            </div>
            <p class="mt-2 font-Inter text-sm sm:text-base text-gray-600">142 stores with verified Fashion coupons, updated daily</p>
        </div>
    </section>

    <section class="py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="grid min-[380px]:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6">
                <a href="#" class="group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/zara.png" alt="Zara" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Zara</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Fashion</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">19 coupons</span>
                </a>

                <a href="#" class="group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/zara.png" alt="Zara" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Zara</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Fashion</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">38 coupons</span>
                </a>

                <a href="#" class="group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/zara.png" alt="Zara" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Zara</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Fashion</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">7 coupons</span>
                </a>

                <a href="#" class="group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/zara.png" alt="Zara" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Zara</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Fashion</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">21 coupons</span>
                </a>

                <a href="#" class="group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/zara.png" alt="Zara" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Zara</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Fashion</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">12 coupons</span>
                </a>

                <a href="#" class="group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/zara.png" alt="Zara" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Zara</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Fashion</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">9 coupons</span>
                </a>

                <a href="#" class="group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/zara.png" alt="Zara" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Zara</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Fashion</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">15 coupons</span>
                </a>

                <a href="#" class="group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/zara.png" alt="Zara" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Zara</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Fashion</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">6 coupons</span>
                </a>

                <a href="#" class="group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/zara.png" alt="Zara" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Zara</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Fashion</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">24 coupons</span>
                </a>

                <a href="#" class="group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                    <div class="flex h-16 w-full items-center justify-center rounded-xl border border-gray-200 bg-white">
                        <img src="/images/brand-logos/zara.png" alt="Zara" class="max-h-16 object-contain">
                    </div>
                    <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">Zara</p>
                    <span class="mt-1.5 rounded-full bg-red-50 px-2.5 py-0.5 font-Inter text-[11px] font-semibold text-red-600">Fashion</span>
                    <span class="mt-1.5 font-Inter text-xs text-gray-500">11 coupons</span>
                </a>
            </div>

            <div class="mt-10 sm:mt-12 flex flex-col items-center gap-3">
                <p class="font-Inter text-sm text-gray-500">Showing 10 of 142 stores</p>
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