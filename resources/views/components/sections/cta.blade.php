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

<div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 p-8 sm:p-12 lg:p-16 border border-slate-800 shadow-2xl text-center">
    <!-- Radial glow accents -->
    <div class="absolute -top-24 -left-24 w-72 h-72 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-brand-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10 max-w-3xl mx-auto space-y-6">
        <x-ui.badge variant="brand" class="bg-brand-500/20 text-brand-300 border-brand-500/30">
            Let's Collaborate
        </x-ui.badge>

        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
            {{ $title }}
        </h2>

        <p class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto">
            {{ $subtitle }}
        </p>

        <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
            <x-ui.button variant="primary" size="lg" :href="$buttonUrl" class="w-full sm:w-auto shadow-brand-500/30">
                <span>{{ $buttonText }}</span>
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </x-ui.button>

            <x-ui.button variant="outline" size="lg" :href="'tel:' . str_replace(' ', '', $phone)" class="w-full sm:w-auto bg-slate-900/80 border-slate-700 text-white hover:bg-slate-800">
                <svg class="w-4 h-4 mr-2 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <span>Call {{ $phone }}</span>
            </x-ui.button>
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
