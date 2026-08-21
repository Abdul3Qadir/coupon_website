<footer class="bg-gray-900 text-gray-300 border-t border-gray-800">
    <div class="mx-auto max-w-7xl px-4 md:px-6 py-12 md:py-16">
        <div class="grid grid-cols-1 min-[400px]:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8 lg:gap-12">
            <div class="md:col-span-1 space-y-4">
                <a href="/" class="inline-block p-2 bg-white rounded-2xl">
                    <img src="/images/coupon-logo.png" alt="Dumdaar Coupons" class="h-10 w-auto">
                </a>
                <p class="text-sm text-gray-400 leading-relaxed">
                    Your ultimate destination for verified coupon codes, discounts, and exclusive deals from top brands.
                </p>
            </div>
            
            <div class="space-y-4">
                <h3 class="text-md font-semibold text-white tracking-wider uppercase">Quick Links</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="/" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="{{ route('stores.index') }}" class="hover:text-white transition-colors">All Stores</a></li>
                    <li><a href="{{ route('categories.index') }}" class="hover:text-white transition-colors">Categories</a></li>
                    <li><a href="{{ route('deals') }}" class="hover:text-white transition-colors">Deals</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-white transition-colors">Blog</a></li>
                    <li><a href="/about" class="hover:text-white transition-colors">About Us</a></li>
                    <li><a href="/contact" class="hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>

            <div class="space-y-4">
                <h3 class="text-md font-semibold text-white tracking-wider uppercase">Categories</h3>
                <ul class="space-y-2.5 text-sm">
                    @forelse ($footerCategories as $category)
                        <li>
                            <a href="{{ route('coupons.category', $category->slug) }}" class="hover:text-white transition-colors">
                                {{ $category->name }}
                            </a>
                        </li>
                    @empty
                        <li><span class="text-gray-500">No categories yet</span></li>
                    @endforelse
                    <li class="pt-1">
                        <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-1 text-red-400 hover:text-red-300 transition-colors font-medium">
                            See All Categories
                            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="space-y-4">
                <h3 class="text-md font-semibold text-white tracking-wider uppercase">Explore</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('stores.index', ['tab' => 'trending']) }}" class="hover:text-white transition-colors">Trending Stores</a></li>
                    <li><a href="{{ route('stores.index', ['tab' => 'new']) }}" class="hover:text-white transition-colors">New Additions</a></li>
                    <li><a href="{{ route('stores.index', ['tab' => 'popular']) }}" class="hover:text-white transition-colors">Popular Stores</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-white transition-colors">Blog & Guides</a></li>
                    <li><a href="{{ route('deals') }}" class="hover:text-white transition-colors">Latest Deals</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-gray-500">
            <p>&copy; 2026 Dumdaar Coupons. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a href="/privacy" class="hover:text-gray-400 transition-colors">Privacy Policy</a>
                <a href="/terms" class="hover:text-gray-400 transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>