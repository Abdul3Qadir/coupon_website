@props(['disabled' => false])
<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-lg border border-gray-200 px-4 py-2.5 font-Inter text-sm text-gray-900 placeholder:text-gray-400 focus:border-red-300 focus:ring-2 focus:ring-red-100 outline-none transition']) }}>
