<x-layouts.admin title="Edit Blog Post">
    <div class="mx-auto max-w-5xl">
        <div class="mb-8 text-center sm:text-left">
            <div class="flex items-center justify-center sm:justify-start gap-2 mb-2">
                <a href="{{ route('admin.blogs.index') }}" class="inline-flex items-center gap-1.5 rounded-lg bg-gray-100 px-3 py-1.5 font-Inter text-xs font-semibold text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition">
                    <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Back to Posts
                </a>
            </div>
            <h1 class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">Edit Post</h1>
            <p class="mt-1 font-Inter text-sm text-gray-500">{{ $blog->title }}</p>
        </div>

        <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-6 items-start">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                @include('admin.blogs._form')
            </div>

            <div class="space-y-4 lg:sticky lg:top-24">
                <div class="rounded-2xl border border-gray-200 bg-white p-5">
                    <h3 class="font-Manrope text-sm font-bold text-gray-900 mb-4">Publish</h3>

                    <div class="mb-3">
                        @php
                            $statusValue = $blog->status->value;
                            $statusLabel = $blog->status->label();
                            if ($statusValue === 'scheduled' && $blog->published_at && $blog->published_at->isPast()) {
                                $statusValue = 'published';
                                $statusLabel = 'Published';
                            }
                        @endphp
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 font-Inter text-xs font-semibold
                            {{ $statusValue === 'published' ? 'bg-emerald-100 text-emerald-700' : ($statusValue === 'scheduled' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-700') }}">
                            {{ $statusLabel }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <label class="block font-Inter text-xs font-semibold text-gray-700 mb-1.5">Schedule Date</label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 font-Inter text-sm text-gray-900 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition" />
                        <p class="mt-1 font-Inter text-xs text-gray-400">Leave blank to publish now. Set future date to schedule.</p>
                    </div>

                    <div class="flex flex-col gap-2">
                        <button type="submit" name="status" value="published" class="w-full cursor-pointer inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 px-5 py-2.5 font-Inter text-sm font-bold text-white hover:bg-red-700 transition">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            Save & Publish
                        </button>
                        <button type="submit" name="status" value="draft" class="w-full cursor-pointer inline-flex items-center justify-center gap-2 rounded-xl bg-gray-100 px-5 py-2.5 font-Inter text-sm font-bold text-gray-700 hover:bg-gray-200 transition">
                            Save as Draft
                        </button>
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5">
                    <h3 class="font-Manrope text-sm font-bold text-gray-900 mb-3">Last Modified</h3>
                    {{-- TIMEZONE FIX (Issue #6): Asia/Karachi timezone --}}
                    <p class="font-Inter text-xs text-gray-500">{{ $blog->updated_at->timezone('Asia/Karachi')->format('M d, Y \a\t h:i A') }}</p>
                </div>

                <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-2.5 font-Inter text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-red-600 transition">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    View Live Post
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>