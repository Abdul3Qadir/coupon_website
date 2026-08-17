<x-layouts.admin title="Blog Posts">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">Blog Posts</h1>
            <p class="mt-1 font-Inter text-sm text-gray-500">Create and manage your articles</p>
        </div>
        <a href="{{ route('admin.blogs.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 px-5 py-2.5 font-Inter text-sm font-semibold text-white hover:bg-red-700 transition shadow-sm shadow-red-200">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
            New Post
        </a>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 font-Inter text-sm font-medium text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-5">
        @forelse ($blogs as $blog)
            <div class="group rounded-2xl border border-gray-200 bg-white overflow-hidden hover:shadow-lg hover:shadow-gray-200/50 transition duration-300">
                <div class="relative h-40 bg-gray-100 overflow-hidden">
                    @if ($blog->feature_image)
                        <img src="{{ asset('storage/' . $blog->feature_image) }}" alt="" class="h-full w-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="flex h-full w-full items-center justify-center text-gray-300">
                            <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3">
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 font-Inter text-[11px] font-semibold
                            {{ $blog->status->value === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $blog->status->label() }}
                        </span>
                    </div>
                </div>

                <div class="p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="font-Inter text-xs text-gray-400">{{ $blog->blogCategory?->name ?? 'Uncategorized' }}</span>
                        <span class="text-gray-300">·</span>
                        <span class="font-Inter text-xs text-gray-400">{{ $blog->created_at->format('M d, Y') }}</span>
                    </div>

                    <h3 class="font-Manrope text-sm font-bold text-gray-900 line-clamp-2 leading-snug">{{ $blog->title }}</h3>

                    {{-- TAGS REMOVED FROM CARDS (Issue #7) --}}

                    <div class="mt-3 flex items-center justify-between pt-3 border-t border-gray-100">
                        <span class="font-Inter text-[11px] text-gray-400">By {{ $blog->admin?->name ?? 'Unknown' }}</span>
                            <div class="flex items-center gap-1">
                            @if ($blog->status->value === 'published')
                                <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="inline-flex items-center gap-1 rounded-lg bg-emerald-50 px-2.5 py-1 font-Inter text-[11px] font-semibold text-emerald-600 hover:bg-emerald-100 transition" title="View Live">
                                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                </a>
                            @endif
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="inline-flex items-center gap-1 rounded-lg bg-gray-100 px-2.5 py-1 font-Inter text-[11px] font-semibold text-gray-700 hover:bg-gray-200 transition">
                                <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 013 3L12 15l-4 1 1-4z"/></svg>
                            </a>
                            <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="confirm-action cursor-pointer inline-flex items-center gap-1 rounded-lg bg-red-50 px-2.5 py-1 font-Inter text-[11px] font-semibold text-red-600 hover:bg-red-100 transition" data-confirm-title="Delete this post?" data-confirm-message="This will permanently remove &quot;{{ $blog->title }}&quot;. This cannot be undone." data-confirm-button="Yes, Delete">
                                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full flex flex-col items-center justify-center rounded-2xl border border-dashed border-gray-300 bg-gray-50/50 py-16">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">
                    <svg class="h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
                </div>
                <h3 class="mt-4 font-Manrope text-base font-bold text-gray-900">No blog posts yet</h3>
                <p class="mt-1 font-Inter text-sm text-gray-500">Get started by creating your first article.</p>
                <a href="{{ route('admin.blogs.create') }}" class="mt-4 inline-flex items-center gap-2 rounded-xl bg-red-600 px-5 py-2.5 font-Inter text-sm font-semibold text-white hover:bg-red-700 transition">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                    Create First Post
                </a>
            </div>
        @endforelse
    </div>

    @if ($blogs->hasPages())
        <div class="mt-8">
            {{ $blogs->links() }}
        </div>
    @endif
</x-layouts.admin>