<section class="py-14 sm:py-20 bg-[#f8f9fb]">
    <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
        <div class="relative text-center">
            <h2 class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">Latest Articles</h2>
            <p class="mt-2 font-Inter text-sm sm:text-base text-gray-600">Shopping tips, saving hacks, and deal roundups</p>
            <a href="{{ route('blog.index') }}" class="hidden sm:inline-flex absolute right-0 top-1/2 -translate-y-1/2 items-center gap-1 font-Inter text-sm font-semibold text-red-600 hover:text-red-700">
                View All
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="mt-10 sm:mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7">
            @forelse ($latestArticles as $article)
            <a href="{{ route('blog.show', $article->slug) }}" class="group flex flex-col rounded-2xl bg-white border border-gray-200 overflow-hidden shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="aspect-16/10 w-full overflow-hidden bg-gray-100">
                    @if($article->feature_image)
                        <img src="{{ asset('storage/' . $article->feature_image) }}" alt="{{ $article->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    @else
                        <div class="h-full w-full bg-gray-200 flex items-center justify-center">
                            <span class="font-Manrope text-sm text-gray-400">No image</span>
                        </div>
                    @endif
                </div>
                <div class="flex flex-1 flex-col p-5">
                    <span class="inline-flex items-center gap-1.5 font-Inter text-xs text-gray-400">
                        <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        {{ $article->created_at->format('F d, Y') }}
                    </span>
                    <h3 class="mt-2.5 font-Manrope text-base sm:text-lg font-bold text-gray-900 line-clamp-2 group-hover:text-red-600 transition">{{ $article->title }}</h3>
                    <p class="mt-2 font-Inter text-sm text-gray-600 line-clamp-2">{{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}</p>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-8">
                <p class="font-Inter text-gray-400">No articles published yet.</p>
            </div>
            @endforelse
        </div>

        <a href="{{ route('blog.index') }}" class="mt-8 flex sm:hidden items-center justify-center gap-1 font-Inter text-sm font-semibold text-red-600">
            View All Articles
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
</section>