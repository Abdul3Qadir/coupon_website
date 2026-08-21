<section class="py-14 sm:py-20">
    <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
        <div class="relative text-center">
            <h2 class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">Shop by Category</h2>
            <p class="mt-2 font-Inter text-sm sm:text-base text-gray-600">Find coupons organized the way you shop</p>
            <a href="{{ route('categories.index') }}" class="hidden sm:inline-flex absolute right-0 top-1/2 -translate-y-1/2 items-center gap-1 font-Inter text-sm font-semibold text-red-600 hover:text-red-700">
                All Categories
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="mt-10 sm:mt-12 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 sm:gap-4">
            @forelse ($categories as $category)
            <a href="{{ route('coupons.category', $category->slug) }}" class="group flex items-center justify-center gap-1.5 rounded-full bg-gray-200 px-4 py-3 transition hover:bg-red-600">
                <span class="font-Manrope text-sm font-semibold text-gray-800 group-hover:text-white truncate">{{ $category->name }}</span>
                <span class="font-Inter text-xs font-medium text-gray-500 group-hover:text-white/60 shrink-0">{{ $category->offers_count }}</span>
            </a>
            @empty
            <div class="col-span-full text-center py-8">
                <p class="font-Inter text-gray-400">No categories available yet.</p>
            </div>
            @endforelse
        </div>

        <a href="{{ route('categories.index') }}" class="mt-8 flex sm:hidden items-center justify-center gap-1 font-Inter text-sm font-semibold text-red-600">
            All Categories
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
</section>