<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <x-seo 
        :title="$title ?? null" 
        :description="$description ?? null" 
        :image="$image ?? null" 
    />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased selection:bg-brand-500 selection:text-white flex flex-col">
    <!-- Navigation Header -->
    <x-layout.header />

    <!-- Flash Alert Messages -->
    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 w-full animate-fade-in-up">
            <x-ui.alert type="success" :message="session('success')" />
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 w-full animate-fade-in-up">
            <x-ui.alert type="error" :message="session('error')" />
        </div>
    @endif

    <!-- Main Page Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-layout.footer />

    <!-- Floating Interactive Quick Contact Action -->
    @php
        $phone = setting('site_phone', config('agency.phone', '+91 7000153244'));
        $whatsapp = config('social.links.whatsapp.url', 'https://wa.me/917000153244');
    @endphp
    <div 
        x-data="{ expanded: false }" 
        class="fixed bottom-6 right-6 z-40 flex flex-col items-end gap-3"
    >
        <!-- Expanded quick action menu -->
        <div 
            x-show="expanded" 
            x-cloak 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-3 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-3 scale-95"
            class="flex flex-col gap-2 p-2 rounded-2xl bg-white/95 backdrop-blur-md border border-slate-200/90 shadow-2xl"
        >
            <a 
                href="{{ $whatsapp }}" 
                target="_blank" 
                rel="noopener noreferrer"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 text-xs font-semibold transition-all group"
            >
                <div class="w-7 h-7 rounded-lg bg-emerald-500 text-white flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                </div>
                <span>WhatsApp Us</span>
            </a>

            <a 
                href="tel:{{ str_replace(' ', '', $phone) }}" 
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-brand-50 text-slate-700 hover:text-brand-700 text-xs font-semibold transition-all group"
            >
                <div class="w-7 h-7 rounded-lg bg-brand-500 text-white flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <span>Call Directly</span>
            </a>

            <a 
                href="{{ route('contact') }}" 
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-slate-100 text-slate-700 hover:text-slate-900 text-xs font-semibold transition-all group border-t border-slate-100"
            >
                <div class="w-7 h-7 rounded-lg bg-slate-900 text-white flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </div>
                <span>Project Form</span>
            </a>
        </div>

        <!-- Toggle Button -->
        <button 
            type="button" 
            @click="expanded = !expanded" 
            class="relative w-13 h-13 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-600 text-white flex items-center justify-center shadow-lg shadow-brand-500/35 hover:shadow-brand-500/50 hover:scale-105 active:scale-95 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-brand-400 focus:ring-offset-2 cursor-pointer"
            aria-label="Quick contact menu"
        >
            <span class="absolute -top-1 -right-1 w-3.5 h-3.5 rounded-full bg-emerald-500 border-2 border-white animate-ping"></span>
            <span class="absolute -top-1 -right-1 w-3.5 h-3.5 rounded-full bg-emerald-500 border-2 border-white"></span>
            
            <svg x-show="!expanded" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <svg x-show="expanded" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</body>
</html>
