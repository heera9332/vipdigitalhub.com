@props([
    'variant' => 'brand',
    'size' => 'md',
])

@php
    $variantClasses = match ($variant) {
        'brand' => 'bg-brand-50 text-brand-700 border-brand-200/80',
        'neutral' => 'bg-slate-100 text-slate-700 border-slate-200',
        'success' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
        'warning' => 'bg-amber-50 text-amber-700 border-amber-200',
        'outline' => 'bg-transparent text-slate-600 border-slate-300',
        default => 'bg-brand-50 text-brand-700 border-brand-200/80',
    };

    $sizeClasses = match ($size) {
        'sm' => 'text-[11px] px-2 py-0.5',
        default => 'text-xs px-2.5 py-1',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center font-medium rounded-full border {$variantClasses} {$sizeClasses}"]) }}>
    {{ $slot }}
</span>
