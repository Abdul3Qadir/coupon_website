<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full cursor-pointer inline-flex items-center justify-center gap-2 rounded-full bg-red-600 hover:bg-red-700 px-6 py-3 font-Manrope text-sm font-bold text-white transition disabled:opacity-50 disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>
