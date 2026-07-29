<button {{ $attributes->merge(['type' => 'button', 'class' => 'w-full cursor-pointer inline-flex items-center justify-center gap-2 rounded-full bg-gray-100 hover:bg-gray-200 px-6 py-3 font-Manrope text-sm font-bold text-gray-800 transition']) }}>
    {{ $slot }}
</button>
