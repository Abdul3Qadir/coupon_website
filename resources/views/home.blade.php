<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
      @include("pages-components.navbar")

      <main class="relative overflow-hidden bg-[#f8f9fb] rounded-b-4xl shadow-[0_25px_50px_-20px_rgba(15,23,42,0.23)]">
    <img src="/images/hero-image.png" alt="Hero Background" class="absolute inset-0 h-full w-full object-cover object-center select-none pointer-events-none">
    <div class="absolute inset-0 bg-white/10"></div>

    <div class="relative max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
        <div class="flex items-center justify-center py-12 sm:py-20">
            <div class="w-full max-w-4xl text-center">
                <h1 class="mt-4 sm:mt-6 font-Manrope text-3xl font-extrabold leading-tight tracking-tight text-gray-900 xs:text-5xl lg:text-6xl">
                    Discover the Best <span class="text-red-600 inline">Coupons & Deals</span> from Top Brands
                </h1>

                <p class="mx-auto mt-3 max-w-2xl font-Inter text-sm sm:text-base leading-6 sm:leading-8 text-gray-600 px-1">
                    Search thousands of verified coupon codes, exclusive offers, and daily discounts from your favorite stores.
                </p>

                <form action="{{ route('stores.index') }}" method="GET" class="mx-auto mt-6 flex max-w-2xl items-center overflow-hidden rounded-full border border-red-200/80 focus-within:border-red-300 bg-white/60 backdrop-blur-md shadow-lg">
                    <div class="relative flex-1">
                        <svg class="absolute left-4 sm:left-5 top-1/2 h-4 w-4 sm:h-5 sm:w-5 -translate-y-1/2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                        </svg>
                        <input type="text" name="q" placeholder="Search stores or brands..."
                            class="w-full pl-11 sm:pl-14 pr-3 font-Inter text-xs sm:text-base placeholder:text-gray-400 focus:outline-none">
                    </div>
                    <button type="submit" class="m-1 min-[500px]:m-1.5 cursor-pointer flex items-center justify-center rounded-full bg-red-500 px-4 sm:px-6 py-3 font-Inter text-sm sm:text-base font-semibold text-white transition hover:bg-red-600 active:bg-red-700 shrink-0">
                        <span class="hidden min-[500px]:inline">Search</span>
                        <svg class="h-4 w-4 min-[500px]:hidden text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                        </svg>
                    </button>
                </form>

                <div class="mt-6 sm:mt-8 flex flex-wrap items-center justify-center gap-2 sm:gap-3 font-Inter text-xs sm:text-sm">
                    <span class="text-gray-500 w-full sm:w-auto mb-1 sm:mb-0">Trending:</span>
                    @forelse ($trendingTags as $tag)
                        <a href="{{ route('stores.show', $tag->slug) }}" class="rounded-full bg-white/90 px-3.5 py-1.5 sm:px-4 sm:py-2 text-gray-700 shadow-sm transition hover:bg-red-500 hover:text-white">
                            {{ $tag->name }}
                        </a>
                    @empty
                        <span class="text-gray-400">No trending stores yet</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</main>
      
    @include("pages-components.brand-carousel")

    @include("pages-components.top-coupons")

    @include("pages-components.featured-stores")
      
    @include("pages-components.trending-stores")
      
    @include("pages-components.popular-stores")

    @include("pages-components.new-stores")

    @include("pages-components.deals")

    @include("pages-components.categories")
      
    <section class="py-14 sm:py-20 bg-[#f8f9fb]">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="text-center">
                <h2 class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">How It Works</h2>
                <p class="mt-2 font-Inter text-sm sm:text-base text-gray-600">Start saving in three simple steps</p>
            </div>

            <div class="relative mt-14 sm:mt-16 grid grid-cols-1 sm:grid-cols-3 gap-12 sm:gap-6">
                <div class="pointer-events-none absolute top-8 left-[16.66%] right-[16.66%] hidden sm:block border-t-2 border-dashed border-gray-300"></div>

                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white border-2 border-red-500 shadow-sm">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </div>
                    <span class="mt-4 font-Inter text-xs font-bold uppercase tracking-wide text-red-600">Step 1</span>
                    <h3 class="mt-1 font-Manrope text-lg font-bold text-gray-900">Choose a Store</h3>
                    <p class="mt-2 max-w-xs font-Inter text-sm text-gray-600">Browse stores or search for the brand you want to shop from.</p>
                </div>

                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white border-2 border-red-500 shadow-sm">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="12" height="12" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
                    </div>
                    <span class="mt-4 font-Inter text-xs font-bold uppercase tracking-wide text-red-600">Step 2</span>
                    <h3 class="mt-1 font-Manrope text-lg font-bold text-gray-900">Copy the Code</h3>
                    <p class="mt-2 max-w-xs font-Inter text-sm text-gray-600">Pick a verified coupon and copy the code with one tap.</p>
                </div>

                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white border-2 border-red-500 shadow-sm">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4"/><path d="M3 6h18"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                    </div>
                    <span class="mt-4 font-Inter text-xs font-bold uppercase tracking-wide text-red-600">Step 3</span>
                    <h3 class="mt-1 font-Manrope text-lg font-bold text-gray-900">Paste &amp; Save</h3>
                    <p class="mt-2 max-w-xs font-Inter text-sm text-gray-600">Apply it at checkout and enjoy the discount instantly.</p>
                </div>
            </div>
        </div>
        <div class="mt-14 sm:mt-16 px-2">
            <div class="max-w-3xl mx-auto rounded-2xl border border-red-100 bg-white px-5 py-6 sm:px-8 sm:py-7 text-center shadow-sm">
                <h3 class="font-Manrope text-lg sm:text-xl font-bold text-gray-900">
                    Verified Coupons You Can Trust
                </h3>
                <p class="mt-3 font-Inter text-sm sm:text-base leading-7 text-gray-600">
                    Every coupon on our platform is carefully verified and updated regularly to help you avoid expired or invalid codes. Shop with confidence and enjoy genuine savings from trusted brands every time.
                </p>
            </div>
        </div>
    </section>

    @include("pages-components.latest-articles")

    <section class="py-14">
        <div class="max-w-3xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="text-center">
                <h2 class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">Frequently Asked Questions</h2>
                <p class="mt-2 font-Inter text-sm sm:text-base text-gray-600">Everything you need to know about using our platform</p>
            </div>

            <div class="mt-10 sm:mt-12 divide-y divide-gray-200 border-t border-b border-gray-200">
                <div class="faq-item">
                    <button type="button" class="faq-toggle flex w-full items-center cursor-pointer justify-between gap-4 py-5 text-left" aria-expanded="false">
                        <span class="font-Manrope text-sm sm:text-base font-semibold text-gray-900">Is our platform free to use?</span>
                        <svg class="faq-icon h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="faq-panel grid overflow-hidden transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                        <div class="overflow-hidden">
                            <p class="pb-5 font-Inter text-sm text-gray-600">Yes, completely free. We never charge you for browsing stores or using coupon codes, and you don't need an account to use them.</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-toggle flex w-full items-center cursor-pointer justify-between gap-4 py-5 text-left" aria-expanded="false">
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
                    <button type="button" class="faq-toggle flex w-full items-center cursor-pointer justify-between gap-4 py-5 text-left" aria-expanded="false">
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
                    <button type="button" class="faq-toggle flex w-full items-center cursor-pointer justify-between gap-4 py-5 text-left" aria-expanded="false">
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
                    <button type="button" class="faq-toggle flex w-full items-center cursor-pointer justify-between gap-4 py-5 text-left" aria-expanded="false">
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
                    <button type="button" class="faq-toggle flex w-full items-center cursor-pointer justify-between gap-4 py-5 text-left" aria-expanded="false">
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
                    <button type="button" class="faq-toggle flex w-full items-center cursor-pointer justify-between gap-4 py-5 text-left" aria-expanded="false">
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
                    <button type="button" class="faq-toggle flex w-full items-center cursor-pointer justify-between gap-4 py-5 text-left" aria-expanded="false">
                        <span class="font-Manrope text-sm sm:text-base font-semibold text-gray-900">What should I do if a store is missing?</span>
                        <svg class="faq-icon h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="faq-panel grid overflow-hidden transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                        <div class="overflow-hidden">
                            <p class="pb-5 font-Inter text-sm text-gray-600">We expand our directory continuously. Simply use the store request form on our website to let us know which brand or retailer you want us to add next.</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-toggle flex w-full items-center cursor-pointer justify-between gap-4 py-5 text-left" aria-expanded="false">
                        <span class="font-Manrope text-sm sm:text-base font-semibold text-gray-900">How do I report an expired or broken deal?</span>
                        <svg class="faq-icon h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="faq-panel grid overflow-hidden transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                        <div class="overflow-hidden">
                            <p class="pb-5 font-Inter text-sm text-gray-600">You can click the feedback or report button directly on any coupon card to let our team know instantly so we can update or remove it right away.</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-toggle flex w-full items-center cursor-pointer justify-between gap-4 py-5 text-left" aria-expanded="false">
                        <span class="font-Manrope text-sm sm:text-base font-semibold text-gray-900">Are there any hidden costs involved?</span>
                        <svg class="faq-icon h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="faq-panel grid overflow-hidden transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                        <div class="overflow-hidden">
                            <p class="pb-5 font-Inter text-sm text-gray-600">None at all. Our service is 100% free for everyone, funded entirely through affiliate partnerships with select stores at no extra cost to you.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("pages-components.footer")
</body>
</html>