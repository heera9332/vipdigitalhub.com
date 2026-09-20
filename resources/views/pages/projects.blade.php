<x-layouts.app 
    title="Case Studies & Client Work — Portfolio"
    description="Explore our portfolio of delivered custom software systems, scalable multi-tenant SaaS platforms, and high-speed web applications."
>
    <!-- Header Hero -->
    <x-ui.section spacing="lg" class="bg-gradient-to-b from-brand-50/50 via-white to-slate-50 border-b border-slate-200/80">
        <x-ui.container>
            <div class="max-w-3xl mx-auto text-center space-y-6">
                <div class="animate-fade-in-up">
                    <x-ui.badge variant="brand">Proven Track Record</x-ui.badge>
                </div>
                
                <h1 class="animate-fade-in-up delay-150 text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-950 tracking-tight leading-tight">
                    Case Studies & <span class="bg-gradient-to-r from-brand-600 to-amber-500 bg-clip-text text-transparent">Client Success</span>
                </h1>

                <p class="animate-fade-in-up delay-250 text-lg sm:text-xl text-slate-600 leading-relaxed max-w-2xl mx-auto font-normal">
                    Explore real-world software platforms, custom ERPs, and high-performance digital products engineered by VIP Digital Hub.
                </p>
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- Projects Grid & Category Filter -->
    <x-ui.section spacing="default" class="bg-slate-50">
        <x-ui.container>
            <!-- Category Filter Pills -->
            <div class="animate-fade-in-up delay-300 flex flex-wrap items-center justify-center gap-2 mb-12">
                <a 
                    href="{{ route('projects') }}" 
                    class="px-4 py-2 rounded-md text-xs font-semibold transition-all duration-200 active:scale-95 {{ empty($selectedCategory) ? 'bg-brand-500 text-white shadow-sm shadow-brand-500/25' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-100' }}"
                >
                    All Work ({{ $projects->total() }})
                </a>
                @foreach ($categories as $category)
                    <a 
                        href="{{ route('projects', ['category' => $category]) }}" 
                        class="px-4 py-2 rounded-md text-xs font-semibold transition-all duration-200 active:scale-95 {{ $selectedCategory === $category ? 'bg-brand-500 text-white shadow-sm shadow-brand-500/25' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-100' }}"
                    >
                        {{ $category }}
                    </a>
                @endforeach
            </div>

            <!-- Projects Grid -->
            @if ($projects->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($projects as $project)
                        <div class="reveal-on-scroll" data-reveal-delay="{{ $loop->index * 80 }}">
                            <x-cards.project :project="$project" />
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 reveal-on-scroll">
                    {{ $projects->links() }}
                </div>
            @else
                <div class="reveal-on-scroll text-center py-16 p-8 rounded-md border border-dashed border-slate-300 bg-white">
                    <p class="text-slate-500 text-sm">No projects found for the selected category.</p>
                    <div class="mt-4">
                        <x-ui.button variant="outline" :href="route('projects')">
                            Clear Filter
                        </x-ui.button>
                    </div>
                </div>
            @endif
        </x-ui.container>
    </x-ui.section>

    <!-- Bottom CTA -->
    <x-ui.section spacing="default" class="bg-white border-t border-slate-200/80">
        <x-ui.container>
            <x-sections.cta 
                title="Have a Project Idea You'd Like to Discuss?"
                subtitle="We'd love to help you validate your architecture and build an MVP that stands out."
                buttonText="Start a Project Discussion"
            />
        </x-ui.container>
    </x-ui.section>
</x-layouts.app>
