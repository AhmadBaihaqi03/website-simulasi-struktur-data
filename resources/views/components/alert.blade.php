@props(['message', 'type' => 'success'])

@php
    $typeConfig = [
        'success' => [
            'bg' => 'bg-emerald-50',
            'border' => 'border-2 border-emerald-200',
            'icon' => '<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>',
            'iconColor' => 'text-emerald-600',
            'textColor' => 'text-emerald-900',
            'buttonHover' => 'hover:bg-emerald-100'
        ],
        'error' => [
            'bg' => 'bg-red-50',
            'border' => 'border-2 border-red-200',
            'icon' => '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>',
            'iconColor' => 'text-red-600',
            'textColor' => 'text-red-900',
            'buttonHover' => 'hover:bg-red-100'
        ],
        'warning' => [
            'bg' => 'bg-amber-50',
            'border' => 'border-2 border-amber-200',
            'icon' => '<path d="M12 2L2 20h20L12 2zm0 5l7 12H5l7-12z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
            'iconColor' => 'text-amber-600',
            'textColor' => 'text-amber-900',
            'buttonHover' => 'hover:bg-amber-100'
        ]
    ];
    $config = $typeConfig[$type] ?? $typeConfig['success'];
@endphp

<div x-data="{ show: true }"
     x-show="show"
     x-init="setTimeout(() => show = false, 3000)"
     x-transition:leave="transition ease-in duration-500"
     class="mb-6 {{ $config['bg'] }} {{ $config['border'] }} rounded-xl shadow-sm p-4 flex items-center justify-between gap-4">

    <div class="flex items-center gap-3 flex-1">
        <svg class="w-5 h-5 flex-shrink-0 {{ $config['iconColor'] }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            {!! $config['icon'] !!}
        </svg>
        <p class="font-semibold text-sm {{ $config['textColor'] }}">{{ $message }}</p>
    </div>

    <button @click="show = false"
            class="flex-shrink-0 {{ $config['iconColor'] }} {{ $config['buttonHover'] }} transition-colors p-2 rounded-lg">
        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </button>
</div>
