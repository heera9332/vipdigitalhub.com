<header 
    x-data="{ mobileOpen: false, scrolled: false }" 
    @scroll.window="scrolled = (window.pageYOffset > 15)"
    :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-md shadow-slate-900/5 border-slate-200/90' : 'bg-white/80 backdrop-blur-sm border-slate-200/60'"
    class="sticky top-0 z-50 w-full border-b transition-all duration-300"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-600 text-white font-bold text-lg shadow-sm shadow-brand-500/20 group-hover:scale-105 group-hover:shadow-brand-500/40 transition-all duration-300">
                    V
                </span>
                <div class="flex flex-col">
                    <span class="text-xl font-bold tracking-tight text-slate-900 group-hover:text-brand-600 transition-colors">
                        VIP <span class="text-brand-500">Digital</span> Hub
                    </span>
                    <span class="text-[11px] font-medium tracking-wider uppercase text-slate-400 -mt-0.5">
                        Software & Growth Agency
                    </span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center gap-1">
                @foreach (config('navigation.main', []) as $item)
                    @php
                        $isActive = $item['route'] ? request()->routeIs($item['route'].'*') : false;
                    @endphp
                    <a 
                        href="{{ $item['url'] }}" 
                        class="px-3.5 py-2 rounded-xl text-sm font-medium transition-all duration-200 relative group {{ $isActive ? 'text-brand-600 bg-brand-50/90 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80 active:scale-95' }}"
                    >
                        <span>{{ $item['label'] }}</span>
                        @if ($isActive)
                            <span class="absolute bottom-1 left-3.5 right-3.5 h-0.5 bg-brand-500 rounded-full"></span>
                        @endif
                    </a>
                @endforeach
            </nav>

            <!-- Desktop CTA -->
            <div class="hidden md:flex items-center gap-4">
                <a 
                    href="{{ route('contact') }}" 
                    class="group relative inline-flex items-center justify-center px-4.5 py-2.5 rounded-xl text-sm font-semibold text-white bg-brand-500 hover:bg-brand-600 shadow-sm shadow-brand-500/25 hover:shadow-lg hover:shadow-brand-500/35 transition-all duration-200 hover:-translate-y-0.5 active:scale-[0.97] cta-shimmer cursor-pointer"
                >
                    <span>Start a Project</span>
                    <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="flex md:hidden items-center">
                <button 
                    type="button" 
                    @click="mobileOpen = !mobileOpen"
                    class="p-2.5 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors focus:outline-none focus:ring-2 focus:ring-brand-500/40 active:scale-95"
                    aria-label="Toggle Navigation"
                >
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div 
        x-show="mobileOpen" 
        x-cloak 
        x-transition:enter="transition ease-out duration-250"
        x-transition:enter-start="opacity-0 -translate-y-3"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-3"
        @click.away="mobileOpen = false"
        class="md:hidden border-b border-slate-200 bg-white/95 px-4 pt-2 pb-6 space-y-2 shadow-xl backdrop-blur-md"
    >
        @foreach (config('navigation.main', []) as $item)
            @php
                $isActive = $item['route'] ? request()->routeIs($item['route'].'*') : false;
            @endphp
            <a 
                href="{{ $item['url'] }}" 
                class="block px-4 py-2.5 rounded-xl text-base font-medium transition-colors {{ $isActive ? 'text-brand-600 bg-brand-50 font-semibold' : 'text-slate-700 hover:text-slate-900 hover:bg-slate-100' }}"
            >
                {{ $item['label'] }}
            </a>
        @endforeach

        <div class="pt-4 border-t border-slate-100">
            <a 
                href="{{ route('contact') }}" 
                class="group flex items-center justify-center w-full px-4 py-3 rounded-xl text-base font-semibold text-white bg-brand-500 hover:bg-brand-600 shadow-md shadow-brand-500/25 active:scale-[0.98] transition-all cta-shimmer"
            >
                <span>Start a Project</span>
                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</header>
