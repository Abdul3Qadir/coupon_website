<x-layouts.admin title="Blog Categories">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h1 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900">Blog Categories</h1>
            <p class="mt-1 font-Inter text-sm text-gray-500">Manage categories for blog articles</p>
        </div>
        <a href="{{ route('admin.blog-categories.create') }}" class="inline-flex items-center gap-1.5 rounded-full bg-red-600 hover:bg-red-700 px-5 py-2.5 font-Manrope text-sm font-bold text-white transition">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Blog Category
        </a>
    </div>

    @session('status')
        <div class="mt-5 rounded-lg bg-emerald-50 px-4 py-3 font-Inter text-sm font-semibold text-emerald-700">
            {{ $value }}
        </div>
    @endsession

    @error('blogCategory')
        <div class="mt-5 rounded-lg bg-red-50 px-4 py-3 font-Inter text-sm font-semibold text-red-700">
            {{ $message }}
        </div>
    @enderror

    <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse ($categories as $category)
            <div class="relative rounded-2xl border border-gray-200 bg-white p-5">
                <div class="flex items-end justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-red-600">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.blog-categories.edit', $category) }}" class="text-gray-400 hover:text-gray-700 -mt-1 transition">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 013 3L12 15l-4 1 1-4z"/></svg>
                        </a>
                        <form method="POST" action="{{ route('admin.blog-categories.destroy', $category) }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="confirm-action cursor-pointer text-gray-400 hover:text-red-600 transition" data-confirm-title="Delete this category?" data-confirm-message="Categories with blogs assigned can't be deleted." data-confirm-button="Yes, Delete">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                <p class="mt-3 font-Manrope text-sm font-bold text-gray-900">{{ $category->name }}</p>
                <p class="font-Inter text-xs text-gray-500">{{ $category->blogs_count }} blogs</p>
            </div>
        @empty
            <p class="col-span-full py-10 text-center font-Inter text-sm text-gray-400">No blog categories yet.</p>
        @endforelse
    </div>
</x-layouts.admin>