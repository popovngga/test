@props(['color' => 'green', 'status'])

@php
    $colorMap = [
        'orange' => 'bg-orange-100 text-orange-800',
        'green' => 'bg-green-100 text-green-800',
        'blue' => 'bg-blue-100 text-blue-800',
        'red' => 'bg-red-100 text-red-800',
    ];

    $classes = $colorMap[$color] ?? $colorMap['green'];
@endphp

@if ($status)
    <div class="{{ $classes }} px-4 py-2 rounded text-sm flex items-center justify-center gap-1 select-text whitespace-nowrap">
        <span>{{ $status }}</span>
        <div>
            {{ $slot }}
        </div>
    </div>
@endif
