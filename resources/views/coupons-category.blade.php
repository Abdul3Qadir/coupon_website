<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} Coupons &amp; Deals</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-Inter">
    @include("pages-components.navbar")

    <section class="pt-10 sm:pt-14">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            <div class="flex items-center gap-1.5 font-Inter text-xs sm:text-sm text-gray-500 mb-5">
                <a href="{{ route('categories.index') }}" class="hover:text-red-600 transition">Categories</a>
                <span>/</span>
                <span class="text-gray-900 font-semibold">{{ $category->name }}</span>
            </div>

            <div class="flex items-center gap-3">
                <x-category-icon-badge :category="$category" small />
                <h1 class="font-Manrope text-2xl sm:text-4xl font-extrabold text-gray-900">{{ $category->name }} Coupons &amp; Deals</h1>
            </div>
            <p class="mt-2 font-Inter text-sm sm:text-base text-gray-600">{{ $stores->total() }} stores with verified {{ $category->name }} coupons</p>
        </div>
    </section>

    <section class="py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-3 xs:px-4 sm:px-8 lg:px-10">
            @if ($stores->isEmpty())
                <p class="py-16 text-center font-Inter text-sm text-gray-500">No stores in this category yet. Check back soon!</p>
            @else
                <div class="grid min-[380px]:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6">
                    @foreach ($stores as $store)
                        <a href="{{ route('stores.show', $store) }}" class="group flex flex-col items-center rounded-2xl bg-white p-5 border border-gray-200 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-red-200">
                            <div class="flex h-16 w-full items-center justify-center">
                                @if ($store->small_logo)
                                    <img src="{{ asset('storage/' . $store->small_logo) }}" alt="{{ $store->name }}" class="max-h-16 object-contain">
                                @else
                                    <x-avatar :name="$store->name" />
                                @endif
                            </div>
                            <p class="mt-3 font-Manrope text-sm font-bold text-gray-900 text-center">{{ $store->name }}</p>
                            <span class="mt-1.5 font-Inter text-xs text-gray-500">{{ $store->offers_count }} coupons</span>
                        </a>
                    @endforeach
                </div>

                <div class="mt-10 sm:mt-12">
                    {{ $stores->links() }}
                </div>
            @endif
        </div>
    </section>

    @include("pages-components.footer")
</body>
</html>