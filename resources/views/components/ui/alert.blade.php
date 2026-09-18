@props([
    'type' => 'success',
    'message' => null,
])

@php
    $typeClasses = match ($type) {
        'success' => 'bg-emerald-50 text-emerald-900 border-emerald-200',
        'error' => 'bg-rose-50 text-rose-900 border-rose-200',
        'warning' => 'bg-amber-50 text-amber-900 border-amber-200',
        default => 'bg-blue-50 text-blue-900 border-blue-200',
    };
    
    $iconColor = match ($type) {
        'success' => 'text-emerald-500',
        'error' => 'text-rose-500',
        'warning' => 'text-amber-500',
        default => 'text-blue-500',
    };
@endphp

<div 
    x-data="{ show: true }" 
    x-show="show" 
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="flex items-start justify-between gap-3 p-4 rounded-xl border {{ $typeClasses }} shadow-sm mb-6"
    role="alert"
>
    <div class="flex items-start gap-3">
        @if ($type === 'success')
            <svg class="w-5 h-5 {{ $iconColor }} shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        @elseif ($type === 'error')
            <svg class="w-5 h-5 {{ $iconColor }} shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        @else
            <svg class="w-5 h-5 {{ $iconColor }} shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        @endif
        <div class="text-sm font-medium leading-relaxed">
            {{ $message ?? $slot }}
        </div>
    </div>
    <button 
        type="button" 
        @click="show = false" 
        class="text-slate-400 hover:text-slate-600 rounded-lg p-1 transition-colors"
        aria-label="Dismiss alert"
    >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
</div>
