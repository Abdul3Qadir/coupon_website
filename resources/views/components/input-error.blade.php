@props(['messages' => []])
@if ($messages)
    <ul {{ $attributes->merge(['class' => 'mt-1.5 space-y-0.5']) }}>
        @foreach ((array) $messages as $message)
            <li class="font-Inter text-xs text-red-600">{{ $message }}</li>
        @endforeach
    </ul>
@endif
