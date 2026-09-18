@props([
    'spacing' => 'default',
    'bg' => 'default',
])

@php
    $spacingClasses = match ($spacing) {
        'sm' => 'py-10 sm:py-14',
        'lg' => 'py-20 sm:py-28',
        'none' => '',
        default => 'py-16 sm:py-20',
    };

    $bgClasses = match ($bg) {
        'white' => 'bg-white',
        'slate' => 'bg-slate-50',
        'dark' => 'bg-slate-950 text-white',
        'subtle' => 'bg-gradient-to-b from-white via-slate-50/60 to-white',
        default => '',
    };
@endphp

<section {{ $attributes->merge(['class' => "relative overflow-hidden {$spacingClasses} {$bgClasses}"]) }}>
    {{ $slot }}
</section>
