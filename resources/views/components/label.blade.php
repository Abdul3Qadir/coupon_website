@props(['value'])
<label {{ $attributes->merge(['class' => 'block font-Inter text-sm font-semibold text-gray-700 mb-1.5']) }}>
    {{ $value ?? $slot }}
</label>
