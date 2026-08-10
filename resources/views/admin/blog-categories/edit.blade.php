<x-layouts.admin title="Edit Blog Category">
    <div class="flex items-center gap-1.5 font-Inter text-sm text-gray-500 mb-5">
        <a href="{{ route('admin.blog-categories.index') }}" class="hover:text-red-600 transition">Blog Categories</a>
        <span>/</span>
        <span class="text-gray-900 font-semibold">Edit {{ $blogCategory->name }}</span>
    </div>

    <div class="max-w-2xl rounded-2xl border border-gray-200 bg-white p-6">
        <h1 class="font-Manrope text-lg font-extrabold text-gray-900">Edit Blog Category</h1>

        <form method="POST" action="{{ route('admin.blog-categories.update', $blogCategory) }}" class="mt-5">
            @csrf
            @method('PUT')

            @include('admin.blog-categories._form')

            <div class="mt-6 flex justify-end">
                <x-primary-button class="w-auto px-8">Save Changes</x-primary-button>
            </div>
        </form>
    </div>
</x-layouts.admin>