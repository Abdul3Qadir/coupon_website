<x-layouts.admin title="Create Blog Post">
    <div class="mx-auto max-w-5xl">
        <div class="mb-8 text-center sm:text-left">
            <div class="flex items-center justify-center sm:justify-start gap-2 mb-2">
                <a href="{{ route('admin.blogs.index') }}" class="inline-flex items-center gap-1.5 rounded-lg bg-gray-100 px-3 py-1.5 font-Inter text-xs font-semibold text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition">
                    <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Back to Posts
                </a>
            </div>
            <h1 class="font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">Create New Post</h1>
            <p class="mt-1 font-Inter text-sm text-gray-500">Write and publish a new article</p>
        </div>

        <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-6 items-start">
            @csrf
            {{-- YEH LINE ADD KARO --}}
            @php $blog = null; @endphp

            <div class="space-y-6">
                @include('admin.blogs._form')
            </div>

            <div class="space-y-4 lg:sticky lg:top-24">
                <div class="rounded-2xl border border-gray-200 bg-white p-5">
                    <h3 class="font-Manrope text-sm font-bold text-gray-900 mb-4">Publish</h3>

                    <div class="flex flex-col gap-2">
                        <button type="submit" name="status" value="published" class="w-full cursor-pointer inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 px-5 py-2.5 font-Inter text-sm font-bold text-white hover:bg-red-700 transition">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            Publish Post
                        </button>
                        <button type="submit" name="status" value="draft" class="w-full cursor-pointer inline-flex items-center justify-center gap-2 rounded-xl bg-gray-100 px-5 py-2.5 font-Inter text-sm font-bold text-gray-700 hover:bg-gray-200 transition">
                            Save as Draft
                        </button>
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5">
                    <h3 class="font-Manrope text-sm font-bold text-gray-900 mb-3">Tips</h3>
                    <ul class="space-y-2 font-Inter text-xs text-gray-500">
                        <li class="flex items-start gap-2">
                            <svg class="h-4 w-4 text-red-500 shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Use a catchy title under 60 characters
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="h-4 w-4 text-red-500 shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Add a focus keyword for SEO
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="h-4 w-4 text-red-500 shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Feature image should be 1200x630px
                        </li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</x-layouts.admin>