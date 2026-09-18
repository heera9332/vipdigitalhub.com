<x-layouts.app 
    title="Engineering & Marketing Blog — Insights & Guides"
    description="In-depth articles, architectural blueprints, and growth marketing guides by the VIP Digital Hub team."
>
    <!-- Header Hero -->
    <x-ui.section spacing="lg" class="bg-gradient-to-b from-brand-50/50 via-white to-slate-50 border-b border-slate-200/80">
        <x-ui.container>
            <div class="max-w-3xl mx-auto text-center space-y-6">
                <div class="animate-fade-in-up">
                    <x-ui.badge variant="brand">Knowledge Base</x-ui.badge>
                </div>
                
                <h1 class="animate-fade-in-up delay-150 text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-950 tracking-tight leading-tight">
                    Articles & <span class="bg-gradient-to-r from-brand-600 to-amber-500 bg-clip-text text-transparent">Engineering Insights</span>
                </h1>

                <p class="animate-fade-in-up delay-250 text-lg sm:text-xl text-slate-600 leading-relaxed max-w-2xl mx-auto font-normal">
                    Deep dives into Laravel architecture, multi-tenant SaaS engineering, high-throughput systems, and data-driven marketing.
                </p>

                <!-- Search Input -->
                <form action="{{ route('posts.index') }}" method="GET" class="animate-fade-in-up delay-300 max-w-md mx-auto pt-2">
                    <div class="relative flex items-center group">
                        <input 
                            type="text" 
                            name="q" 
                            value="{{ $search ?? '' }}" 
                            placeholder="Search articles..." 
                            class="w-full pl-11 pr-24 py-3 rounded-2xl border border-slate-300 bg-white text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 shadow-sm transition-all focus:shadow-md"
                        >
                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-brand-500 transition-colors absolute left-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <button type="submit" class="cta-shimmer absolute right-1.5 px-4 py-1.5 rounded-xl bg-brand-500 text-white font-medium text-xs hover:bg-brand-600 active:scale-95 transition-all shadow-xs">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- Articles Grid & Filters -->
    <x-ui.section spacing="default" class="bg-slate-50">
        <x-ui.container>
            <!-- Category Filter Pills -->
            <div class="animate-fade-in-up delay-300 flex flex-wrap items-center justify-center gap-2 mb-12">
                <a 
                    href="{{ route('posts.index') }}" 
                    class="px-4 py-2 rounded-xl text-xs font-semibold transition-all duration-200 active:scale-95 {{ empty($selectedCategory) && empty($search) ? 'bg-brand-500 text-white shadow-sm shadow-brand-500/25' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 hover:border-slate-300' }}"
                >
                    All Articles ({{ $posts->total() }})
                </a>
                @foreach ($categories as $cat)
                    <a 
                        href="{{ route('posts.index', ['category' => $cat]) }}" 
                        class="px-4 py-2 rounded-xl text-xs font-semibold transition-all duration-200 active:scale-95 {{ $selectedCategory === $cat ? 'bg-brand-500 text-white shadow-sm shadow-brand-500/25' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 hover:border-slate-300' }}"
                    >
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Posts Grid -->
            @if ($posts->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($posts as $post)
                        <div class="reveal-on-scroll" data-reveal-delay="{{ $loop->index * 80 }}">
                            <x-cards.post :post="$post" />
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 reveal-on-scroll">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="reveal-on-scroll text-center py-16 p-8 rounded-2xl border border-dashed border-slate-300 bg-white max-w-lg mx-auto">
                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <p class="text-slate-600 text-sm font-medium">No articles matched your criteria.</p>
                    <p class="text-slate-400 text-xs mt-1">Try resetting the search or category filter.</p>
                    <div class="mt-4">
                        <x-ui.button variant="outline" size="sm" :href="route('posts.index')">
                            Reset Search
                        </x-ui.button>
                    </div>
                </div>
            @endif
        </x-ui.container>
    </x-ui.section>

    <!-- Bottom CTA -->
    <x-ui.section spacing="default" class="bg-white border-t border-slate-200/80">
        <x-ui.container>
            <div class="reveal-on-scroll">
                <x-sections.cta 
                    title="Want to Put These Engineering Principles Into Practice?"
                    subtitle="We build high-performance software for ambitious teams. Get in touch to discuss your next build."
                    buttonText="Work With Our Engineers"
                />
            </div>
        </x-ui.container>
    </x-ui.section>
</x-layouts.app>
