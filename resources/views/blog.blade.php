<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    @include("pages-components.navbar")

    <section class="pt-10 sm:pt-14">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="flex items-center gap-1.5 font-Inter text-xs sm:text-sm text-gray-500 mb-5">
                <a href="#" class="hover:text-red-600 transition">Home</a>
                <span>/</span>
                <span class="text-gray-900 font-semibold">Blog</span>
            </div>

            <h1 class="font-Manrope text-2xl sm:text-4xl font-extrabold text-gray-900">Coupono Blog</h1>
            <p class="mt-2 font-Inter text-sm sm:text-base text-gray-600">Shopping tips, saving hacks, and deal roundups from the Coupono team</p>
        </div>
    </section>

    <section class="border-b border-gray-200 mt-8">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="flex items-center gap-2.5 overflow-x-auto py-3 no-scrollbar">
                <button type="button" class="cursor-pointer shrink-0 rounded-full bg-gray-900 px-4 py-2 font-Manrope text-sm font-semibold text-white">All Posts</button>
                <button type="button" class="cursor-pointer shrink-0 rounded-full bg-gray-50 hover:bg-gray-900 hover:text-white px-4 py-2 font-Manrope text-sm font-semibold text-gray-800 transition">Shopping Tips</button>
                <button type="button" class="cursor-pointer shrink-0 rounded-full bg-gray-50 hover:bg-gray-900 hover:text-white px-4 py-2 font-Manrope text-sm font-semibold text-gray-800 transition">Deal Guides</button>
                <button type="button" class="cursor-pointer shrink-0 rounded-full bg-gray-50 hover:bg-gray-900 hover:text-white px-4 py-2 font-Manrope text-sm font-semibold text-gray-800 transition">Store News</button>
                <button type="button" class="cursor-pointer shrink-0 rounded-full bg-gray-50 hover:bg-gray-900 hover:text-white px-4 py-2 font-Manrope text-sm font-semibold text-gray-800 transition">Seasonal Sales</button>
            </div>
        </div>
    </section>

    <section class="py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7">
                <a href="/blog/article" class="group flex flex-col rounded-2xl bg-white border border-gray-200 overflow-hidden shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="aspect-16/10 w-full overflow-hidden bg-gray-100">
                        <img src="/images/article1.webp" alt="10 Smart Ways to Save More While Shopping Online" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        <span class="inline-flex items-center gap-1.5 font-Inter text-xs text-gray-400">
                            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            July 20, 2026
                        </span>
                        <h3 class="mt-2.5 font-Manrope text-base sm:text-lg font-bold text-gray-900 line-clamp-2 group-hover:text-red-600 transition">10 Smart Ways to Save More While Shopping Online</h3>
                        <p class="mt-2 font-Inter text-sm text-gray-600 line-clamp-2">From stacking coupons to timing your cart just right, these are the small habits that add up to real savings every month.</p>
                    </div>
                </a>

                <a href="/blog/article" class="group flex flex-col rounded-2xl bg-white border border-gray-200 overflow-hidden shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="aspect-16/10 w-full overflow-hidden bg-gray-100">
                        <img src="/images/article2.webp" alt="Black Friday 2026: What Pakistani Shoppers Need to Know" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        <span class="inline-flex items-center gap-1.5 font-Inter text-xs text-gray-400">
                            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            July 15, 2026
                        </span>
                        <h3 class="mt-2.5 font-Manrope text-base sm:text-lg font-bold text-gray-900 line-clamp-2 group-hover:text-red-600 transition">Black Friday 2026: What Pakistani Shoppers Need to Know</h3>
                        <p class="mt-2 font-Inter text-sm text-gray-600 line-clamp-2">Which local and international stores go all-in, when the best drops usually land, and how to avoid the fake countdown timers.</p>
                    </div>
                </a>

                <a href="/blog/article" class="group flex flex-col rounded-2xl bg-white border border-gray-200 overflow-hidden shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="aspect-16/10 w-full overflow-hidden bg-gray-100">
                        <img src="/images/article1.webp" alt="How to Spot a Fake Coupon Code Before You Get Scammed" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        <span class="inline-flex items-center gap-1.5 font-Inter text-xs text-gray-400">
                            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            July 8, 2026
                        </span>
                        <h3 class="mt-2.5 font-Manrope text-base sm:text-lg font-bold text-gray-900 line-clamp-2 group-hover:text-red-600 transition">How to Spot a Fake Coupon Code Before You Get Scammed</h3>
                        <p class="mt-2 font-Inter text-sm text-gray-600 line-clamp-2">A few quick checks separate a verified code from a scraper-bot listing that will waste your time at checkout.</p>
                    </div>
                </a>

                <a href="/blog/article" class="group flex flex-col rounded-2xl bg-white border border-gray-200 overflow-hidden shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="aspect-16/10 w-full overflow-hidden bg-gray-100">
                        <img src="/images/article2.webp" alt="Hostinger vs GoDaddy: Which Hosting Deal Actually Saves More" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        <span class="inline-flex items-center gap-1.5 font-Inter text-xs text-gray-400">
                            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            July 3, 2026
                        </span>
                        <h3 class="mt-2.5 font-Manrope text-base sm:text-lg font-bold text-gray-900 line-clamp-2 group-hover:text-red-600 transition">Hostinger vs GoDaddy: Which Hosting Deal Actually Saves More</h3>
                        <p class="mt-2 font-Inter text-sm text-gray-600 line-clamp-2">We compared renewal pricing, not just the first-year discount, to see which host actually costs less over three years.</p>
                    </div>
                </a>

                <a href="/blog/article" class="group flex flex-col rounded-2xl bg-white border border-gray-200 overflow-hidden shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="aspect-16/10 w-full overflow-hidden bg-gray-100">
                        <img src="/images/article1.webp" alt="The Best Time to Book Flights for Cheaper Fares" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        <span class="inline-flex items-center gap-1.5 font-Inter text-xs text-gray-400">
                            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            June 28, 2026
                        </span>
                        <h3 class="mt-2.5 font-Manrope text-base sm:text-lg font-bold text-gray-900 line-clamp-2 group-hover:text-red-600 transition">The Best Time to Book Flights for Cheaper Fares</h3>
                        <p class="mt-2 font-Inter text-sm text-gray-600 line-clamp-2">Airline pricing isn't random. Here's what actually moves fares up and down before you book your next trip.</p>
                    </div>
                </a>

                <a href="/blog/article" class="group flex flex-col rounded-2xl bg-white border border-gray-200 overflow-hidden shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="aspect-16/10 w-full overflow-hidden bg-gray-100">
                        <img src="/images/article2.webp" alt="Zara Sale Calendar: When Prices Actually Drop" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        <span class="inline-flex items-center gap-1.5 font-Inter text-xs text-gray-400">
                            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            June 22, 2026
                        </span>
                        <h3 class="mt-2.5 font-Manrope text-base sm:text-lg font-bold text-gray-900 line-clamp-2 group-hover:text-red-600 transition">Zara Sale Calendar: When Prices Actually Drop</h3>
                        <p class="mt-2 font-Inter text-sm text-gray-600 line-clamp-2">End-of-season clearance follows a pattern every year. Here's when to wait and when to buy now.</p>
                    </div>
                </a>
            </div>

            <div class="mt-10 sm:mt-12 flex flex-col items-center gap-3">
                <p class="font-Inter text-sm text-gray-500">Showing 6 of 42 articles</p>
                <button type="button" class="cursor-pointer inline-flex items-center gap-2 rounded-full bg-white border border-gray-200 hover:border-red-200 hover:bg-red-50 px-6 py-3 font-Manrope text-sm font-semibold text-gray-900 hover:text-red-600 shadow-sm transition">
                    Load More Articles
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
                </button>
            </div>
        </div>
    </section>

    @include("pages-components.footer")
</body>
</html>