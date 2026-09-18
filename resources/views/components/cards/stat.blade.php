@props([
    'value',
    'label',
    'description' => null,
])

<div class="rounded-2xl border border-slate-200/90 bg-white p-6 shadow-sm flex flex-col justify-between">
    <div>
        <div class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900 bg-gradient-to-r from-slate-900 via-brand-600 to-brand-500 bg-clip-text text-transparent mb-1">
            {{ $value }}
        </div>
        <div class="text-sm font-bold text-slate-800 mb-1">
            {{ $label }}
        </div>
        @if ($description)
            <p class="text-xs text-slate-500 leading-relaxed">
                {{ $description }}
            </p>
        @endif
    </div>
</div>
