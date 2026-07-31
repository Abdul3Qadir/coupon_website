@props(['checked' => false, 'action', 'label' => null])
<form method="POST" action="{{ $action }}" class="toggle-form inline-flex items-center gap-2">
    @csrf
    <button type="submit" @class([
        'relative inline-flex h-6 w-11 shrink-0 cursor-pointer items-center rounded-full transition',
        'bg-red-600' => $checked,
        'bg-gray-200' => !$checked,
    ])>
        <span @class([
            'inline-block h-4.5 w-4.5 transform rounded-full bg-white shadow transition',
            'translate-x-6' => $checked,
            'translate-x-1' => !$checked,
        ])></span>
    </button>
    @if ($label)
        <span class="font-Inter text-sm text-gray-700">{{ $label }}</span>
    @endif
</form>