@props(['title', 'subtitle' => null])
<div class="min-h-screen flex flex-col items-center justify-center bg-[#f8f9fb] px-4 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-6">
            <a href="/" class="font-Manrope text-2xl font-extrabold text-gray-900">Coupono</a>
        </div>
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8">
            <h1 class="font-Manrope text-xl sm:text-2xl font-extrabold text-gray-900 text-center">{{ $title }}</h1>
            @if ($subtitle)
                <p class="mt-1.5 text-center font-Inter text-sm text-gray-600">{{ $subtitle }}</p>
            @endif
            <div class="mt-6">
                {{ $slot }}
            </div>
        </div>
        @isset($footer)
            <p class="mt-6 text-center font-Inter text-sm text-gray-600">{{ $footer }}</p>
        @endisset
    </div>
</div>
