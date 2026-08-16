<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->seo_title ?? $blog->title }} — Coupono</title>
    <meta name="description" content="{{ $blog->seo_description ?? $blog->excerpt }}">
    @if ($blog->focus_keyword)
        <meta name="keywords" content="{{ $blog->focus_keyword }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter bg-white text-gray-900">

    @include("pages-components.navbar")

    {{-- Article Header --}}
    <header class="mx-auto max-w-3xl px-4 pt-12 pb-8 sm:px-6">
        @if ($blog->blogCategory)
            <a href="{{ route('blog.index', ['category' => $blog->blogCategory->slug]) }}" class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1 font-Inter text-xs font-semibold text-red-600 hover:bg-red-100 transition">
                {{ $blog->blogCategory->name }}
            </a>
        @endif

        <h1 class="mt-4 font-Manrope text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl">{{ $blog->title }}</h1>

        <div class="mt-4 flex flex-wrap items-center gap-4 text-sm text-gray-500">
            <div class="flex items-center gap-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-red-100 font-Manrope text-xs font-bold text-red-600">
                    {{ strtoupper(substr($blog->admin?->name ?? 'A', 0, 1)) }}
                </div>
                <span class="font-Inter font-medium text-gray-700">{{ $blog->admin?->name ?? 'Admin' }}</span>
            </div>
            <span class="text-gray-300">|</span>
            <span class="font-Inter">{{ $blog->published_at?->format('F d, Y') ?? $blog->created_at->format('F d, Y') }}</span>
            @if ($blog->tags->count())
                <span class="text-gray-300">|</span>
                <div class="flex flex-wrap gap-1.5">
                    @foreach ($blog->tags as $tag)
                        <span class="rounded-full bg-gray-100 px-2.5 py-0.5 font-Inter text-xs text-gray-600">{{ $tag->name }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </header>

    {{-- Feature Image --}}
    @if ($blog->feature_image)
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <figure class="overflow-hidden rounded-2xl">
                <img src="{{ asset('storage/' . $blog->feature_image) }}" alt="{{ $blog->image_alt ?? $blog->title }}" title="{{ $blog->image_title }}" class="h-auto w-full object-cover">
                @if ($blog->image_caption)
                    <figcaption class="mt-2 text-center font-Inter text-sm text-gray-500">{{ $blog->image_caption }}</figcaption>
                @endif
            </figure>
        </div>
    @endif

    {{-- Article Content --}}
    <article class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
        @if ($blog->excerpt)
            <p class="mb-8 font-Inter text-lg leading-relaxed text-gray-600 italic border-l-4 border-red-200 pl-4">{{ $blog->excerpt }}</p>
        @endif

        <div class="prose prose-lg prose-red max-w-none font-Inter text-gray-700 leading-relaxed">
            {!! $blog->content !!}
        </div>
    </article>

    {{-- Related Posts --}}
    @if ($relatedBlogs->count())
        <section class="border-t border-gray-100 bg-gray-50/50 py-12">
            <div class="mx-auto max-w-6xl px-4 sm:px-6">
                <h2 class="font-Manrope text-xl font-bold text-gray-900 mb-6">Related Articles</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    @foreach ($relatedBlogs as $related)
                        <a href="{{ route('blog.show', $related->slug) }}" class="group rounded-2xl border border-gray-200 bg-white overflow-hidden hover:shadow-lg transition">
                            <div class="h-40 bg-gray-100 overflow-hidden">
                                @if ($related->feature_image)
                                    <img src="{{ asset('storage/' . $related->feature_image) }}" alt="" class="h-full w-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-gray-300">
                                        <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-Manrope text-sm font-bold text-gray-900 line-clamp-2">{{ $related->title }}</h3>
                                <p class="mt-1 font-Inter text-xs text-gray-500">{{ $related->published_at?->format('M d, Y') ?? $related->created_at->format('M d, Y') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Footer --}}
    <footer class="border-t border-gray-100 bg-white py-8">
        <div class="mx-auto max-w-6xl px-4 text-center">
            <p class="font-Inter text-sm text-gray-500">Coupono Blog — Saving you money, one coupon at a time.</p>
        </div>
    </footer>

</body>
</html>