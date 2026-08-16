@props(['status'])

@php
    $key = is_object($status) ? $status->value : $status;

    $map = [
        'pending'     => ['bg-amber-50',  'text-amber-700',  'Pending'],
        'approved'    => ['bg-emerald-50', 'text-emerald-700', 'Approved'],
        'verified'    => ['bg-emerald-50', 'text-emerald-700', 'Verified'],
        'rejected'    => ['bg-red-50',    'text-red-700',    'Rejected'],
        'suspended'   => ['bg-gray-200',  'text-gray-700',   'Suspended'],
        'draft'       => ['bg-gray-100',  'text-gray-600',   'Draft'],
        'scheduled'   => ['bg-amber-100', 'text-amber-700',  'Scheduled'],
        'published'   => ['bg-emerald-50', 'text-emerald-700', 'Published'],
    ];

    [$bg, $text, $label] = $map[$key] ?? ['bg-gray-100', 'text-gray-600', ucfirst($key)];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full {$bg} {$text} px-2.5 py-1 font-Inter text-xs font-semibold"]) }}>
    {{ $label }}
</span>