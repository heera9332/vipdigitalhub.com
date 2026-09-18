@props([
    'hover' => false,
])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-sm transition-all ' . ($hover ? 'hover:shadow-md hover:border-slate-300 hover:-translate-y-1' : '')]) }}>
    {{ $slot }}
</div>
