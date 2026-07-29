@props(['href', 'active' => false, 'badge' => null])
<a href="{{ $href }}" @class([
    'flex items-center justify-between gap-3 rounded-lg px-3 py-2.5 font-Inter text-sm font-semibold transition',
    'bg-red-50 text-red-600' => $active,
    'text-gray-600 hover:bg-gray-50 hover:text-gray-900' => !$active,
])>
    <span class="flex items-center gap-3">
        @isset($icon)
            <span class="h-5 w-5 shrink-0">{{ $icon }}</span>
        @endisset
        {{ $slot }}
    </span>
    @if ($badge)
        <span class="flex h-5 min-w-5 items-center justify-center rounded-full bg-red-600 px-1.5 font-Inter text-[11px] font-bold text-white">
            {{ $badge }}
        </span>
    @endif
</a>
