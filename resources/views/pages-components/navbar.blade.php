<header class="sticky top-0 z-50 bg-white/70 backdrop-blur-xl border-b border-gray-200/50">
    <div class="mx-auto max-w-7xl px-4 md:px-6 h-18 flex items-center justify-between gap-6">
        
        <!-- Logo Section -->
        <div class="flex items-center gap-3 shrink-0">
            <a href="/" class="flex items-center">
                <img src="/images/coupon-logo.png" alt="Dumdaar Coupons" class="max-[300px]:h-8 block h-10 w-auto">
            </a>
        </div>

        <div class="hidden lg:flex flex-1 max-w-md relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400 group-focus-within:text-slate-700 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" placeholder="Search brands, coupons..." class="w-full bg-gray-50 border border-gray-200 rounded-full pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:outline-none focus:border-red-300 transition-all duration-300">
        </div>

        <!-- Elegant Nav Links -->
        <nav class="hidden min-[790px]:flex items-center gap-6 text-sm font-medium text-gray-600 shrink-0">
            <a href="/stores" class="relative group transition-all duration-200 {{ request()->is('stores') ? 'text-red-500' : 'text-gray-600 hover:text-red-400' }}">
                Stores
                <span class="absolute -bottom-1 left-0 h-0.5 bg-red-300 transition-all {{ request()->is('stores') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
            <a href="/categories" class="relative group transition-all duration-200 {{ request()->is('categories') ? 'text-red-500' : 'text-gray-600 hover:text-red-400' }}">
                Categories
                <span class="absolute -bottom-1 left-0 h-0.5 bg-red-300 transition-all {{ request()->is('categories') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
            <a href="/about" class="relative group transition-all duration-200 {{ request()->is('about') ? 'text-red-500' : 'text-gray-600 hover:text-red-400' }}">
                About
                <span class="absolute -bottom-1 left-0 h-0.5 bg-red-300 transition-all {{ request()->is('about') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
            <a href="/blog" class="relative group transition-all duration-200 {{ request()->is('blog') ? 'text-red-500' : 'text-gray-600 hover:text-red-400' }}">
                Blog
                <span class="absolute -bottom-1 left-0 h-0.5 bg-red-300 transition-all {{ request()->is('blog') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
            <div class="relative group">
                @auth('admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-1.5 transition-all duration-200 relative text-gray-600 hover:text-red-400">
                        Admin Dashboard
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-300 transition-all hover:w-full"></span>
                    </a>
                @elseif(auth('brand')->check())
                    <a href="{{ route('brand.dashboard') }}" class="flex items-center gap-1.5 transition-all duration-200 relative text-gray-600 hover:text-red-400">
                        Brand Dashboard
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-300 transition-all hover:w-full"></span>
                    </a>
                @else
                    <button class="flex items-center gap-1 group-hover:text-red-400 transition-all duration-200 relative">
                        For Brands
                        <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-300 transition-all group-hover:w-full"></span>
                    </button>
                    <div class="absolute top-full left-0 mt-3 w-50 rounded-xl bg-gray-50 border border-gray-200 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="/brand/register" class="flex items-center gap-3 px-3 py-3 hover:bg-gray-100 text-sm text-gray-700">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Join as Brand
                        </a>
                        <a href="/brand/login" class="flex items-center gap-3 px-3 py-3 hover:bg-gray-100 text-sm text-gray-700 rounded-b-2xl">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3" />
                            </svg>
                            Brand Login
                        </a>
                    </div>
                @endauth
            </div>
        </nav>

        <div class="flex items-center gap-3 shrink-0">
            <a href="/deals" class="sm:flex hidden items-center gap-2 bg-gray-900 text-white text-sm font-semibold px-5 py-2.5 rounded-full hover:bg-black transition-all duration-300 hover:shadow-sm hover:shadow-gray-900/20 active:scale-95">
                <svg class="size-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/><line x1="11" y1="11" x2="11.01" y2="11"/>
                </svg>
                Get Deals
            </a>
            <button id="mobile-search-btn" class="min-[790px]:hidden p-2 border border-gray-700 rounded-full">
                <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
            <button class="min-[790px]:hidden w-10 h-10 rounded-full flex items-center justify-center hover:bg-gray-100 transition-colors" aria-label="Open menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
</header>
 <!-- Mobile Ham burger -->
<div id="mobile-menu" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="absolute inset-y-0 left-0 w-4/5 max-w-xs bg-white h-full shadow-2xl -translate-x-full transition-transform duration-300 ease-in-out flex flex-col">
        <div class="flex items-center justify-between p-5 border-b border-gray-100">
            <span class="font-bold font-Inter text-gray-800 text-lg">Explore</span>
            <button id="close-menu-btn" class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <nav class="flex flex-col p-5 gap-2 font-medium text-gray-700">
            <a href="/stores" class="hover:text-red-400 transition-colors py-2 border-b border-gray-50">Stores</a>
            <a href="/categories" class="hover:text-red-400 transition-colors py-2 border-b border-gray-50">Categories</a>
            <a href="/blog" class="hover:text-red-400 transition-colors py-2 border-b border-gray-50">About</a>
            <a href="/blog" class="hover:text-red-400 transition-colors py-2 border-b border-gray-50">Blog</a>

            <div class="mt-4 pt-4 border-t border-gray-100">
                @auth('admin')
                    <p class="px-2 mb-3 text-xs font-semibold uppercase tracking-wider text-gray-400">Admin</p>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 py-3 px-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-red-400 transition-all duration-200">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Admin Dashboard</span>
                    </a>
                @elseif(auth('brand')->check())
                    <p class="px-2 mb-3 text-xs font-semibold uppercase tracking-wider text-gray-400">Your Brand</p>
                    <a href="{{ route('brand.dashboard') }}" class="flex items-center gap-3 py-3 px-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-red-400 transition-all duration-200">
                        <span>Brand Dashboard</span>
                    </a>
                @else
                    <p class="px-2 mb-3 text-xs font-semibold uppercase tracking-wider text-gray-400">For Brands</p>
                    <a href="/brand/register" class="flex items-center gap-3 py-3 px-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-red-400 transition-all duration-200">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Join as Brand</span>
                    </a>
                    <a href="/brand/login" class="flex items-center gap-3 py-3 px-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-red-400 transition-all duration-200">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3" />
                        </svg>
                        <span>Brand Login</span>
                    </a>
                @endauth
            </div>
        </nav>
        
        <div class="p-5 mt-auto border-t border-gray-100">
            <a href="/deals" class="flex items-center justify-center gap-2 bg-gray-900 text-white text-sm font-semibold px-5 py-3 rounded-full hover:bg-black transition-all">
                <svg class="size-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/><line x1="11" y1="11" x2="11.01" y2="11"/>
                </svg>
                Get Deals
            </a>
        </div>
    </div>
</div>
 <!-- Mobile Search -->
<div id="mobile-search-modal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300 flex items-start justify-center pt-20 px-4">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-4 -translate-y-10 transition-transform duration-300 ease-in-out">
        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
            <span class="font-semibold font-Inter text-gray-800 text-sm">Search Coupons & Brands</span>
            <button id="close-search-btn" class="p-1.5 rounded-full hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="relative mt-4">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" placeholder="Search brands, coupons..." class="w-full bg-gray-50 border border-gray-200 rounded-full pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:outline-none focus:border-red-300 transition-all">
        </div>
    </div>
</div>