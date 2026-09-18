@props([
    'title',
    'slug',
    'shortDescription',
    'features' => [],
    'icon' => 'globe',
    'cta' => 'Learn More & Inquire',
])

<div class="group relative rounded-2xl border border-slate-200/90 bg-white p-7 shadow-sm transition-all duration-300 hover:shadow-xl hover:border-brand-300 hover:-translate-y-1.5 flex flex-col justify-between">
    <div>
        <!-- Icon Container -->
        <div class="w-12 h-12 rounded-xl bg-brand-50 border border-brand-100/80 flex items-center justify-center text-brand-600 mb-5 group-hover:bg-brand-500 group-hover:text-white transition-all duration-300 shadow-sm">
            @if ($icon === 'globe')
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
            @elseif ($icon === 'code')
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
            @elseif ($icon === 'cloud')
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 00-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
            @elseif ($icon === 'layers')
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            @elseif ($icon === 'device-mobile' || $icon === 'smartphone')
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            @elseif ($icon === 'chart-bar' || $icon === 'trending-up')
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            @elseif ($icon === 'palette')
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4 5 5 0 013-4.5 4 4 0 017.5-1.5A5.5 5.5 0 0119 15.5 4.5 4.5 0 0114.5 20c-1.5 0-2.5-1-3.5-1s-2 1-4 2z"/></svg>
            @else
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            @endif
        </div>

        <h3 class="text-xl font-bold text-slate-900 group-hover:text-brand-600 transition-colors mb-2">
            {{ $title }}
        </h3>
        
        <p class="text-slate-600 text-sm leading-relaxed mb-6">
            {{ $shortDescription }}
        </p>

        @if (!empty($features))
            <div class="space-y-2 mb-6 pt-4 border-t border-slate-100">
                @foreach ($features as $feature)
                    <div class="flex items-center text-xs text-slate-600">
                        <svg class="w-4 h-4 text-brand-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ $feature }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
        <a 
            href="{{ route('contact', ['service' => $slug]) }}" 
            class="text-xs font-semibold text-brand-600 group-hover:text-brand-700 inline-flex items-center gap-1.5 hover:gap-2 transition-all"
        >
            <span>{{ $cta }}</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>
    </div>
</div>
