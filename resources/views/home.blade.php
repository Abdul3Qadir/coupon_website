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

                <div class="mx-auto mt-6 flex max-w-2xl items-center overflow-hidden rounded-full border border-red-200/80 focus-within:border-red-300 bg-white/60 backdrop-blur-md shadow-lg">
                    
                    <div class="relative flex-1">
                        <svg class="absolute left-4 sm:left-5 top-1/2 h-4 w-4 sm:h-5 sm:w-5 -translate-y-1/2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                        </svg>

                        <input type="text" placeholder="Search stores or brands..."
                            class="w-full pl-11 sm:pl-14 pr-3 font-Inter text-xs sm:text-base placeholder:text-gray-400 focus:outline-none">
                    </div>

                    <button type="button" class="m-1 min-[500px]:m-1.5 cursor-pointer flex items-center justify-center rounded-full bg-red-500 px-4 sm:px-6 py-3 font-Inter text-sm sm:text-base font-semibold text-white transition hover:bg-red-600 active:bg-red-700 shrink-0">
                        <span class="hidden min-[500px]:inline">Search</span>
                        <svg class="h-4 w-4 min-[500px]:hidden text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                        </svg>
                    </button>

                </div>

                <div class="mt-6 sm:mt-8 flex flex-wrap items-center justify-center gap-2 sm:gap-3 font-Inter text-xs sm:text-sm">
                    <span class="text-gray-500 w-full sm:w-auto mb-1 sm:mb-0">
                        Trending:
                    </span>
                    <a href="#" class="rounded-full bg-white/90 px-3.5 py-1.5 sm:px-4 sm:py-2 text-gray-700 shadow-sm transition hover:bg-red-500 hover:text-white">
                        Amazon
                    </a>
                    <a href="#" class="rounded-full bg-white/90 px-3.5 py-1.5 sm:px-4 sm:py-2 text-gray-700 shadow-sm transition hover:bg-red-500 hover:text-white">
                        Walmart
                    </a>
                    <a href="#" class="rounded-full bg-white/90 px-3.5 py-1.5 sm:px-4 sm:py-2 text-gray-700 shadow-sm transition hover:bg-red-500 hover:text-white">
                        Target
                    </a>
                    <a href="#" class="rounded-full bg-white/90 px-3.5 py-1.5 sm:px-4 sm:py-2 text-gray-700 shadow-sm transition hover:bg-red-500 hover:text-white">
                        Best Buy
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
      
    @include("pages-components.braand-carousel")
      
    @include("pages-components.trending-stores")
      
    @include("pages-components.popular-stores")
      
    @include("pages-components.top-coupons")
      
    @include("pages-components.categories")

    @include("pages-components.footer")
</body>
</html>