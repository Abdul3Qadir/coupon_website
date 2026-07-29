@props(['label', 'value', 'trend' => null, 'trendUp' => true])
<div class="rounded-2xl border border-gray-200 bg-white p-5">
    <p class="font-Inter text-sm text-gray-500">{{ $label }}</p>
    <p class="mt-2 font-Manrope text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $value }}</p>
    @if ($trend)
        <p @class([
            'mt-1.5 inline-flex items-center gap-1 font-Inter text-xs font-semibold',
            'text-emerald-600' => $trendUp,
            'text-red-600' => !$trendUp,
        ])>
            @if ($trendUp)
                <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
            @else
                <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            @endif
            {{ $trend }}
        </p>
    @endif
</div>
