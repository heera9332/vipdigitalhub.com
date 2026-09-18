@props([
    'project',
])

<div class="group relative rounded-2xl border border-slate-200/90 bg-white overflow-hidden shadow-sm transition-all duration-300 hover:shadow-xl hover:border-brand-300 hover:-translate-y-1.5 flex flex-col justify-between">
    <!-- Visual Header / Mockup Banner -->
    <div class="relative h-52 w-full bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 p-6 flex flex-col justify-between overflow-hidden">
        <div class="absolute inset-0 bg-radial-gradient from-brand-500/15 via-transparent to-transparent"></div>
        <div class="absolute -right-8 -bottom-8 w-40 h-40 bg-brand-500/10 rounded-full blur-2xl group-hover:bg-brand-500/20 transition-all"></div>
        
        <!-- Mock window header dots -->
        <div class="relative z-10 flex items-center justify-between">
            <div class="flex items-center gap-1.5">
                <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-amber-500/80"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></span>
            </div>
            <x-ui.badge variant="brand" size="sm" class="bg-brand-500/20 text-brand-300 border-brand-500/30">
                {{ $project->category }}
            </x-ui.badge>
        </div>

        <div class="relative z-10">
            <div class="text-xs font-mono text-brand-400 font-medium tracking-wide">
                {{ $project->client ?? 'Client Case Study' }}
            </div>
            <div class="text-lg font-bold text-white tracking-tight line-clamp-1 group-hover:text-brand-300 transition-colors">
                {{ $project->title }}
            </div>
        </div>
    </div>

    <!-- Body content -->
    <div class="p-6 flex flex-col flex-grow justify-between">
        <div>
            <p class="text-slate-600 text-sm leading-relaxed mb-5 line-clamp-3">
                {{ $project->short_description }}
            </p>

            <!-- Technologies -->
            @if (!empty($project->technologies))
                <div class="flex flex-wrap gap-1.5 mb-6">
                    @foreach (array_slice($project->technologies, 0, 4) as $tech)
                        <x-ui.badge variant="neutral" size="sm">
                            {{ $tech }}
                        </x-ui.badge>
                    @endforeach
                    @if (count($project->technologies) > 4)
                        <x-ui.badge variant="neutral" size="sm">
                            +{{ count($project->technologies) - 4 }}
                        </x-ui.badge>
                    @endif
                </div>
            @endif
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
            <a 
                href="{{ route('projects.show', $project) }}" 
                class="text-xs font-semibold text-brand-600 group-hover:text-brand-700 inline-flex items-center gap-1.5 hover:gap-2 transition-all"
            >
                <span>View Case Study</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>

            @if ($project->year)
                <span class="text-[11px] font-mono text-slate-400">
                    {{ $project->year }}
                </span>
            @endif
        </div>
    </div>
</div>
