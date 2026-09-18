<x-layouts.app 
    :title="$project->title . ' — Case Study'"
    :description="$project->short_description"
>
    <!-- Breadcrumb & Hero Header -->
    <x-ui.section spacing="default" class="bg-gradient-to-b from-brand-50/40 via-white to-slate-50 border-b border-slate-200/80">
        <x-ui.container>
            <div class="max-w-4xl mx-auto space-y-6">
                <!-- Breadcrumbs -->
                <nav class="animate-fade-in-up flex items-center gap-2 text-xs font-medium text-slate-500">
                    <a href="{{ route('home') }}" class="hover:text-brand-600 transition-colors">Home</a>
                    <span>/</span>
                    <a href="{{ route('projects') }}" class="hover:text-brand-600 transition-colors">Projects</a>
                    <span>/</span>
                    <span class="text-slate-800 line-clamp-1">{{ $project->title }}</span>
                </nav>

                <div class="animate-fade-in-up delay-100 flex flex-wrap items-center gap-3">
                    <x-ui.badge variant="brand">{{ $project->category }}</x-ui.badge>
                    @if ($project->year)
                        <span class="text-xs font-mono text-slate-500">{{ $project->year }}</span>
                    @endif
                </div>

                <h1 class="animate-fade-in-up delay-150 text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                    {{ $project->title }}
                </h1>

                <p class="animate-fade-in-up delay-250 text-lg text-slate-600 leading-relaxed">
                    {{ $project->short_description }}
                </p>

                <!-- Project Meta Grid -->
                <div class="animate-fade-in-up delay-300 pt-6 border-t border-slate-200 grid grid-cols-2 sm:grid-cols-4 gap-6 text-left">
                    <div class="p-3 rounded-xl hover:bg-slate-50 transition-colors">
                        <div class="text-xs uppercase font-mono text-slate-400 font-semibold">Client</div>
                        <div class="text-sm font-bold text-slate-900 mt-1">{{ $project->client ?? 'Confidential' }}</div>
                    </div>
                    <div class="p-3 rounded-xl hover:bg-slate-50 transition-colors">
                        <div class="text-xs uppercase font-mono text-slate-400 font-semibold">Category</div>
                        <div class="text-sm font-bold text-slate-900 mt-1">{{ $project->category }}</div>
                    </div>
                    <div class="p-3 rounded-xl hover:bg-slate-50 transition-colors">
                        <div class="text-xs uppercase font-mono text-slate-400 font-semibold">Year</div>
                        <div class="text-sm font-bold text-slate-900 mt-1">{{ $project->year ?? date('Y') }}</div>
                    </div>
                    <div class="p-3 rounded-xl hover:bg-slate-50 transition-colors">
                        <div class="text-xs uppercase font-mono text-slate-400 font-semibold">Live URL</div>
                        <div class="text-sm font-bold text-brand-600 mt-1">
                            @if ($project->project_url)
                                <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 hover:underline">
                                    <span>Visit Site</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            @else
                                <span class="text-slate-400 font-normal">Internal Enterprise App</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- Case Study Body & Details -->
    <x-ui.section spacing="default" class="bg-white">
        <x-ui.container>
            <div class="max-w-4xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Stylized Terminal / App Preview Mockup -->
                    <div class="reveal-on-scroll rounded-2xl border border-slate-800 bg-slate-950 p-6 shadow-xl text-white space-y-4">
                        <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                                <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                                <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                            </div>
                            <span class="text-xs font-mono text-slate-400">Production Release {{ $project->year }}</span>
                        </div>
                        <div class="py-6 text-center space-y-2">
                            <div class="text-xs font-mono text-brand-400 uppercase tracking-widest">Architecture Solution</div>
                            <div class="text-xl font-bold text-white">{{ $project->title }}</div>
                            <p class="text-xs text-slate-400 max-w-md mx-auto">Engineered by VIP Digital Hub for zero-downtime scalability and high performance.</p>
                        </div>
                    </div>

                    <div class="reveal-on-scroll space-y-4" data-reveal-delay="100">
                        <h2 class="text-2xl font-bold text-slate-950">Overview & Challenges</h2>
                        <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed space-y-4 text-base">
                            <p>{{ $project->description }}</p>
                        </div>
                    </div>

                    <!-- Key Deliverables -->
                    <div class="reveal-on-scroll space-y-4 pt-4 border-t border-slate-100" data-reveal-delay="150">
                        <h3 class="text-xl font-bold text-slate-950">Key Engineering Deliverables</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-4 rounded-xl border border-slate-200/90 bg-slate-50 space-y-1.5 hover:shadow-sm hover:border-brand-300 transition-all">
                                <div class="text-xs font-bold text-slate-900">Custom Architecture</div>
                                <p class="text-xs text-slate-600">Tailored data schemas, optimized database queries, and modular components.</p>
                            </div>
                            <div class="p-4 rounded-xl border border-slate-200/90 bg-slate-50 space-y-1.5 hover:shadow-sm hover:border-brand-300 transition-all">
                                <div class="text-xs font-bold text-slate-900">Automated Testing</div>
                                <p class="text-xs text-slate-600">Feature and unit test suites ensuring stability and zero regressions.</p>
                            </div>
                            <div class="p-4 rounded-xl border border-slate-200/90 bg-slate-50 space-y-1.5 hover:shadow-sm hover:border-brand-300 transition-all">
                                <div class="text-xs font-bold text-slate-900">High-Speed API</div>
                                <p class="text-xs text-slate-600">Fast RESTful endpoints with rate limiting and secure JWT/Sanctum authentication.</p>
                            </div>
                            <div class="p-4 rounded-xl border border-slate-200/90 bg-slate-50 space-y-1.5 hover:shadow-sm hover:border-brand-300 transition-all">
                                <div class="text-xs font-bold text-slate-900">Responsive Interfaces</div>
                                <p class="text-xs text-slate-600">Sub-second load times with clean Tailwind CSS utility classes.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Tech Stack Box -->
                    <div class="reveal-on-scroll p-6 rounded-2xl border border-slate-200/90 bg-slate-50 space-y-4 hover:shadow-md transition-shadow" data-reveal-delay="100">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900">Technologies Used</h3>
                        @if (!empty($project->technologies))
                            <div class="flex flex-wrap gap-2">
                                @foreach ($project->technologies as $tech)
                                    <x-ui.badge variant="brand" size="md">
                                        {{ $tech }}
                                    </x-ui.badge>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-slate-500">Laravel, Tailwind CSS, MySQL</p>
                        @endif
                    </div>

                    <!-- Inquire About Similar Project Card -->
                    <div class="reveal-on-scroll p-6 rounded-2xl border border-brand-200 bg-brand-50/50 space-y-4 hover:shadow-md transition-shadow" data-reveal-delay="200">
                        <div class="w-10 h-10 rounded-xl bg-brand-500 text-white flex items-center justify-center font-bold shadow-sm shadow-brand-500/25">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-900">Need a Similar Solution?</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            We can tailor a system with similar architecture and scale for your specific business requirements.
                        </p>
                        <x-ui.button variant="primary" size="sm" :href="route('contact', ['service' => str($project->category)->slug()->toString()])" class="w-full">
                            Discuss Your Project
                        </x-ui.button>
                    </div>
                </div>
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- Related Projects -->
    @if ($relatedProjects->isNotEmpty())
        <x-ui.section spacing="default" class="bg-slate-50 border-t border-slate-200/80">
            <x-ui.container>
                <div class="reveal-on-scroll mb-10 flex items-center justify-between">
                    <div>
                        <x-ui.badge variant="brand">Portfolio</x-ui.badge>
                        <h2 class="text-2xl font-bold text-slate-950 mt-2">More Case Studies</h2>
                    </div>
                    <x-ui.button variant="outline" size="sm" :href="route('projects')">
                        All Projects
                    </x-ui.button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($relatedProjects as $rel)
                        <div class="reveal-on-scroll" data-reveal-delay="{{ $loop->index * 100 }}">
                            <x-cards.project :project="$rel" />
                        </div>
                    @endforeach
                </div>
            </x-ui.container>
        </x-ui.section>
    @endif
</x-layouts.app>
