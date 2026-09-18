@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-xl transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-60 disabled:cursor-not-allowed';
    
    $variantClasses = match ($variant) {
        'primary' => 'bg-brand-500 hover:bg-brand-600 text-white shadow-sm shadow-brand-500/25 hover:shadow-brand-500/35 focus:ring-brand-500 hover:-translate-y-0.5',
        'secondary' => 'bg-slate-900 hover:bg-slate-800 text-white shadow-sm focus:ring-slate-900 hover:-translate-y-0.5',
        'outline' => 'border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 hover:text-slate-900 focus:ring-slate-400',
        'ghost' => 'text-slate-700 hover:text-brand-600 hover:bg-brand-50/50 focus:ring-brand-400',
        'destructive' => 'bg-rose-600 hover:bg-rose-700 text-white shadow-sm focus:ring-rose-500',
        default => 'bg-brand-500 hover:bg-brand-600 text-white',
    };

    $sizeClasses = match ($size) {
        'sm' => 'text-xs px-3 py-1.5 gap-1.5',
        'lg' => 'text-base px-6 py-3.5 gap-2.5 shadow-md',
        default => 'text-sm px-4.5 py-2.5 gap-2',
    };

    $classes = "{$baseClasses} {$variantClasses} {$sizeClasses}";
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
