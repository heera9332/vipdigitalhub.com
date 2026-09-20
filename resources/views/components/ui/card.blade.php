@props([
    'hover' => false,
])

<div {{ $attributes->merge(['class' => 'rounded-md border border-slate-200/90 bg-white p-4 shadow-sm transition-all ' . ($hover ? 'hover:shadow-md hover:border-slate-300 hover:-translate-y-1' : '')]) }}>
    {{ $slot }}
</div>
