@props(['data', 'color' => 'red'])
@php
    $colorMap = [
        'red' => 'from-red-500 to-rose-400',
        'emerald' => 'from-emerald-500 to-teal-400',
    ];
    $gradient = $colorMap[$color] ?? $colorMap['red'];
    $max = max(1, ...array_values($data));
@endphp
<div class="flex items-end justify-between gap-2 h-32">
    @foreach ($data as $label => $value)
        @php $heightPct = max(4, round(($value / $max) * 100)); @endphp
        <div class="flex flex-1 flex-col items-center gap-2">
            <div class="w-full flex items-end h-24">
                <div class="w-full rounded-t-md bg-linear-to-t {{ $gradient }}" style="height: {{ $heightPct }}%" title="{{ $value }}"></div>
            </div>
            <span class="font-Inter text-[10px] font-medium text-gray-400">{{ $label }}</span>
        </div>
    @endforeach
</div>