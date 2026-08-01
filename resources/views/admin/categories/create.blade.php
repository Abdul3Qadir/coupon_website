<x-layouts.admin title="Add Category">
    <div class="flex items-center gap-1.5 font-Inter text-sm text-gray-500 mb-5">
        <a href="{{ route('admin.categories.index') }}" class="hover:text-red-600 transition">Categories</a>
        <span>/</span>
        <span class="text-gray-900 font-semibold">Add New</span>
    </div>

    <div class="max-w-2xl rounded-2xl border border-gray-200 bg-white p-6">
        <h1 class="font-Manrope text-lg font-extrabold text-gray-900">Add New Category</h1>

        <form method="POST" action="{{ route('admin.categories.store') }}" class="mt-5">
            @csrf

            @php $category = null; @endphp
            @include('admin.categories._form')

            <div class="mt-6 flex justify-end">
                <x-primary-button class="w-auto px-8">Create Category</x-primary-button>
            </div>
        </form>
    </div>
</x-layouts.admin>