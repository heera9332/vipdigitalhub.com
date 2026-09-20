@props([
    'title' => 'Ready to Build Something Extraordinary?',
    'subtitle' => 'Partner with VIP Digital Hub to turn your product vision into high-performance web applications and scalable revenue growth.',
    'buttonText' => 'Start Your Project Today',
    'buttonUrl' => null,
])

@php
    $buttonUrl = $buttonUrl ?? route('contact');
    $phone = setting('site_phone', config('agency.phone', '+91 7000153244'));
    $email = setting('site_email', config('agency.email', 'vipdigitalhub@gmail.com'));
@endphp

<div class="reveal-on-scroll relative overflow-hidden rounded-md bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 p-8 sm:p-12 lg:p-16 border border-slate-800/80 shadow-2xl text-center">
    <!-- Ambient glowing lights -->
    <div class="absolute -top-24 -left-24 w-80 h-80 bg-brand-500/20 rounded-full blur-3xl pointer-events-none animate-pulse-glow"></div>
    <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-amber-500/20 rounded-full blur-3xl pointer-events-none animate-float"></div>

    <div class="relative z-10 max-w-3xl mx-auto space-y-6">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full border border-brand-500/30 bg-brand-500/10 text-brand-300 text-xs font-semibold shadow-xs">
            <span class="w-2 h-2 rounded-full bg-brand-400 animate-pulse"></span>
            <span>Let's Collaborate</span>
        </div>

        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
            {{ $title }}
        </h2>

        <p class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto">
            {{ $subtitle }}
        </p>

        <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a 
                href="{{ $buttonUrl }}" 
                class="group relative inline-flex items-center justify-center w-full sm:w-auto px-7 py-4 rounded-md text-base font-semibold text-white bg-brand-500 hover:bg-brand-600 shadow-lg shadow-brand-500/30 hover:shadow-brand-500/50 transition-all duration-200 hover:-translate-y-0.5 active:scale-[0.98] cta-shimmer cursor-pointer"
            >
                <span>{{ $buttonText }}</span>
                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>

            <a 
                href="tel:{{ str_replace(' ', '', $phone) }}" 
                class="group inline-flex items-center justify-center w-full sm:w-auto px-6 py-4 rounded-md text-sm font-semibold text-white bg-slate-900/90 border border-slate-700/80 hover:bg-slate-800/90 hover:border-slate-600 shadow-md transition-all duration-200 hover:-translate-y-0.5 active:scale-[0.98]"
            >
                <svg class="w-4 h-4 mr-2 text-brand-400 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <span>Call {{ $phone }}</span>
            </a>
        </div>

        <div class="pt-4 flex flex-wrap items-center justify-center gap-6 text-xs text-slate-400">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>Free Initial Consultation</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>Fixed-Price & Milestone Options</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>NDA Protected</span>
            </div>
        </div>
    </div>
</div>
