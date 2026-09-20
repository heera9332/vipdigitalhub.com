<x-layouts.admin title="Case Studies">
    <x-slot:header>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Portfolio & Case Studies</h1>
                <p class="text-xs text-slate-500 mt-0.5">Manage custom software, SaaS systems, and digital transformations delivered to clients.</p>
            </div>
            <a 
                href="{{ route('admin.projects.create') }}" 
                class="cta-shimmer inline-flex items-center gap-2 px-4 py-2.5 rounded-md bg-brand-500 text-white font-semibold text-xs hover:bg-brand-600 shadow-sm shadow-brand-500/25 active:scale-95 transition-all"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Add Case Study</span>
            </a>
        </div>
    </x-slot:header>

    <div class="space-y-6">
        <!-- Search & Filter Bar -->
        <div class="p-4 rounded-md bg-white border border-slate-200/90 shadow-xs flex flex-col md:flex-row gap-3 items-center justify-between">
            <form action="{{ route('admin.projects.index') }}" method="GET" class="flex-1 w-full flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ $search ?? '' }}" 
                        placeholder="Search by title, client, or category..." 
                        class="w-full pl-10 pr-4 py-2 rounded-md border border-slate-300 bg-white text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>

                <div class="flex gap-2">
                    <select 
                        name="category" 
                        class="px-3 py-2 rounded-md border border-slate-300 bg-white text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                        <option value="">All Categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ ($selectedCategory ?? '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>

                    <select 
                        name="status" 
                        class="px-3 py-2 rounded-md border border-slate-300 bg-white text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                        <option value="">All Statuses</option>
                        <option value="published" {{ ($status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ ($status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>

                    <button type="submit" class="px-4 py-2 rounded-md bg-slate-900 text-white font-medium text-xs hover:bg-slate-800 transition-colors">
                        Filter
                    </button>

                    @if ($search || $selectedCategory || $status)
                        <a href="{{ route('admin.projects.index') }}" class="px-3 py-2 rounded-md border border-slate-200 text-slate-600 text-xs hover:bg-slate-100 transition-colors flex items-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Projects Table -->
        <div class="bg-white rounded-md border border-slate-200/90 shadow-xs overflow-hidden">
            @if ($projects->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Project Title</th>
                                <th class="px-6 py-4">Client</th>
                                <th class="px-6 py-4">Category</th>
                                <th class="px-6 py-4">Featured</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @foreach ($projects as $project)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-6 py-4 max-w-sm">
                                        <a href="{{ route('admin.projects.edit', $project) }}" class="font-bold text-slate-900 hover:text-brand-600 text-sm line-clamp-1">
                                            {{ $project->title }}
                                        </a>
                                        <div class="text-[11px] text-slate-400 font-mono mt-0.5 truncate">/projects/{{ $project->slug }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-slate-800">
                                        {{ $project->client ?? 'Confidential' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-brand-50 text-brand-700">
                                            {{ $project->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($project->featured)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                                Featured
                                            </span>
                                        @else
                                            <span class="text-slate-400 text-xs">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($project->status === 'published')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                                Published
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-200 text-slate-800">
                                                {{ ucfirst($project->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a 
                                                href="{{ route('projects.show', $project) }}" 
                                                target="_blank" 
                                                class="p-1.5 rounded-lg border border-slate-200 text-slate-500 hover:text-brand-600 hover:border-brand-200 transition-colors"
                                                title="View Case Study"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            <a 
                                                href="{{ route('admin.projects.edit', $project) }}" 
                                                class="p-1.5 rounded-lg border border-slate-200 text-slate-500 hover:text-blue-600 hover:border-blue-200 transition-colors"
                                                title="Edit Case Study"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this case study?');">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit" 
                                                    class="p-1.5 rounded-lg border border-slate-200 text-slate-500 hover:text-rose-600 hover:border-rose-200 transition-colors"
                                                    title="Delete Case Study"
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-slate-100">
                    {{ $projects->links() }}
                </div>
            @else
                <div class="p-12 text-center space-y-3">
                    <svg class="w-12 h-12 text-slate-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <p class="text-sm font-semibold text-slate-800">No projects found.</p>
                    <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-md bg-brand-500 text-white text-xs font-semibold hover:bg-brand-600">
                        Add First Case Study
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>
