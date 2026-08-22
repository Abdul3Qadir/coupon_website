<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog — FavCoupons</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    @include("pages-components.navbar")

    <section class="pt-10 sm:pt-14">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="flex items-center gap-1.5 font-Inter text-xs sm:text-sm text-gray-500 mb-5">
                <a href="/" class="hover:text-red-600 transition">Home</a>
                <span>/</span>
                <span class="text-gray-900 font-semibold">Blog</span>
            </div>

            <h1 class="font-Manrope text-2xl sm:text-4xl font-extrabold text-gray-900">FavCoupons Blog</h1>
            <p class="mt-2 font-Inter text-sm sm:text-base text-gray-600">Shopping tips, saving hacks, and deal roundups from the FavCoupons team</p>
        </div>
    </section>

    @php
        $activeCategory = request('category', 'all');
    @endphp

    <section class="border-b border-gray-200 mt-8">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="flex items-center gap-2.5 overflow-x-auto py-3 no-scrollbar">
                <a href="{{ route('blog.index') }}" class="cursor-pointer shrink-0 rounded-full {{ $activeCategory === 'all' ? 'bg-gray-900 text-white' : 'bg-gray-50 text-gray-800 hover:bg-gray-900 hover:text-white' }} px-4 py-2 font-Manrope text-sm font-semibold transition">
                    All Posts
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('blog.index', ['category' => $category->slug]) }}" class="cursor-pointer shrink-0 rounded-full {{ $activeCategory === $category->slug ? 'bg-gray-900 text-white' : 'bg-gray-50 text-gray-800 hover:bg-gray-900 hover:text-white' }} px-4 py-2 font-Manrope text-sm font-semibold transition">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7">
                @forelse ($blogs as $blog)
                    <a href="{{ route('blog.show', $blog->slug) }}" class="group flex flex-col rounded-2xl bg-white border border-gray-200 overflow-hidden shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="aspect-16/10 w-full overflow-hidden bg-gray-100">
                            @if ($blog->feature_image)
                                <img src="{{ asset('storage/' . $blog->feature_image) }}" alt="{{ $blog->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-gray-100 text-gray-300">
                                    <svg class="h-12 w-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-1 flex-col p-5">
                            <span class="inline-flex items-center gap-1.5 font-Inter text-xs text-gray-400">
                                <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                {{ $blog->published_at?->format('F d, Y') ?? $blog->created_at->format('F d, Y') }}
                            </span>
                            <h3 class="mt-2.5 font-Manrope text-base sm:text-lg font-bold text-gray-900 line-clamp-2 group-hover:text-red-600 transition">{{ $blog->title }}</h3>
                            <p class="mt-2 font-Inter text-sm text-gray-600 line-clamp-2">{{ $blog->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($blog->content), 120) }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-16">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">
                            <svg class="h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
                        </div>
                        <h3 class="mt-4 font-Manrope text-base font-bold text-gray-900">No articles found</h3>
                        <p class="mt-1 font-Inter text-sm text-gray-500">Try selecting a different category.</p>
                    </div>
                @endforelse
            </div>

            @if ($blogs->hasPages())
                <div class="mt-10 sm:mt-12 flex flex-col items-center gap-3">
                    <p class="font-Inter text-sm text-gray-500">Showing {{ $blogs->firstItem() ?? 0 }} - {{ $blogs->lastItem() ?? 0 }} of {{ $blogs->total() }} articles</p>
                    @if ($blogs->hasMorePages())
                        <a href="{{ $blogs->nextPageUrl() }}" class="cursor-pointer inline-flex items-center gap-2 rounded-full bg-white border border-gray-200 hover:border-red-200 hover:bg-red-50 px-6 py-3 font-Manrope text-sm font-semibold text-gray-900 hover:text-red-600 shadow-sm transition">
                            Load More Articles
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    @include("pages-components.footer")
</body>
</html>