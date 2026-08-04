@props(['category', 'small' => false])
@php
    $colorMap = [
        'rose' => 'bg-rose-50 text-rose-600',
        'blue' => 'bg-blue-50 text-blue-600',
        'emerald' => 'bg-emerald-50 text-emerald-600',
        'amber' => 'bg-amber-50 text-amber-600',
        'violet' => 'bg-violet-50 text-violet-600',
        'pink' => 'bg-pink-50 text-pink-600',
        'orange' => 'bg-orange-50 text-orange-600',
        'teal' => 'bg-teal-50 text-teal-600',
        'indigo' => 'bg-indigo-50 text-indigo-600',
        'cyan' => 'bg-cyan-50 text-cyan-600',
    ];
    $classes = $colorMap[$category->color] ?? 'bg-red-50 text-red-600';
@endphp
@if ($small)
    <span {{ $attributes->merge(['class' => "flex h-11 w-11 items-center justify-center rounded-xl {$classes} [&>svg]:h-6 [&>svg]:w-6"]) }}>
        {!! $category->icon !!}
    </span>
@else
    <span {{ $attributes->merge(['class' => "flex h-14 w-14 items-center justify-center rounded-2xl {$classes} [&>svg]:h-7 [&>svg]:w-7"]) }}>
        {!! $category->icon !!}
    </span>
@endif