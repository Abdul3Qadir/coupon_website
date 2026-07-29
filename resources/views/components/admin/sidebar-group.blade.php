@props(['label'])
<p {{ $attributes->merge(['class' => 'px-3 mt-6 mb-2 font-Inter text-[11px] font-bold uppercase tracking-wider text-gray-400']) }}>
    {{ $label }}
</p>
