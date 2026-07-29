@props(['name', 'size' => 'md'])
@php
    $colors = [
        'bg-rose-100 text-rose-700',
        'bg-sky-100 text-sky-700',
        'bg-emerald-100 text-emerald-700',
        'bg-amber-100 text-amber-700',
        'bg-violet-100 text-violet-700',
        'bg-indigo-100 text-indigo-700',
    ];

    $words = collect(explode(' ', trim((string) $name)))->filter();
    $initials = $words->map(fn ($word) => mb_substr($word, 0, 1))->take(2)->implode('');
    $colorClass = $colors[abs(crc32((string) $name)) % count($colors)];

    $sizeClass = match ($size) {
        'sm' => 'h-8 w-8 text-xs',
        'lg' => 'h-12 w-12 text-base',
        default => 'h-10 w-10 text-sm',
    };
@endphp
<span {{ $attributes->merge(['class' => "inline-flex shrink-0 items-center justify-center rounded-full font-Manrope font-bold {$colorClass} {$sizeClass}"]) }}>
    {{ strtoupper($initials ?: '?') }}
</span>
