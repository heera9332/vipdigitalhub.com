@props([
    'quote',
    'author',
    'role',
    'company' => null,
    'rating' => 5,
])

<div class="rounded-2xl border border-slate-200/90 bg-white p-7 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
    <div>
        <!-- Star rating -->
        <div class="flex items-center gap-1 text-amber-400 mb-4">
            @for ($i = 0; $i < $rating; $i++)
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            @endfor
        </div>

        <p class="text-slate-700 text-sm leading-relaxed italic mb-6">
            "{{ $quote }}"
        </p>
    </div>

    <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
        <div class="w-10 h-10 rounded-full bg-brand-100 text-brand-700 flex items-center justify-center font-bold text-sm">
            {{ substr($author, 0, 1) }}
        </div>
        <div>
            <div class="text-sm font-semibold text-slate-900">{{ $author }}</div>
            <div class="text-xs text-slate-500">
                {{ $role }}{{ $company ? ' · ' . $company : '' }}
            </div>
        </div>
    </div>
</div>
