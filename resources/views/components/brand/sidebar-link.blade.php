@props(['href', 'active' => false, 'badge' => null])
<a href="{{ $href }}" @class([
    'relative flex items-center gap-3 rounded-xl px-4 py-3.5 font-Inter text-[15px] font-semibold transition',
    'bg-red-50 text-red-600' => $active,
    'text-gray-600 hover:bg-gray-50 hover:text-gray-900' => !$active,
])>
    @if ($active)
        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-full bg-red-600"></span>
    @endif
    @isset($icon)
        <span @class(['flex h-9 w-9 shrink-0 items-center justify-center rounded-lg', 'bg-red-100 text-red-600' => $active, 'bg-gray-100 text-gray-500' => !$active])>
            {{ $icon }}
        </span>
    @endisset
    <span class="flex-1">{{ $slot }}</span>
    @if ($badge)
        <span class="flex h-6 min-w-6 items-center justify-center rounded-full bg-red-600 px-2 font-Inter text-xs font-bold text-white">
            {{ $badge }}
        </span>
    @endif
</a>
