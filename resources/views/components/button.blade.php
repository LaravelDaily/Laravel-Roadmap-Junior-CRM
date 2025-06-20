@props([
    'type' => 'primary',
    'buttonType' => 'submit',
    'tag' => 'button',
])

@php
    $styleClasses = \Illuminate\Support\Arr::toCssClasses([
        'text-white font-medium py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors flex items-center justify-center',
        match ($type) {
            'primary' => 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500',
            'danger' => 'bg-red-600 hover:bg-red-700 focus:ring-red-500',
        },
    ]);
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $styleClasses]) }}>
    {{ $slot }}
    </{{ $tag }}>
