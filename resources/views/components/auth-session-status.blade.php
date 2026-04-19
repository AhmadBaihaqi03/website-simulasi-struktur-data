@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-indigo-600 p-3 bg-indigo-50 border-l-4 border-indigo-600 rounded-lg']) }}>
        {{ $status }}
    </div>
@endif
