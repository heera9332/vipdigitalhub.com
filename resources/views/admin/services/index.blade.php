<x-layouts.admin title="Services">
    <x-slot:header>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Services & Offerings</h1>
                <p class="text-xs text-slate-500 mt-0.5">Manage software development, cloud, and digital marketing service offerings.</p>
            </div>
            <a 
                href="{{ route('admin.services.create') }}" 
                class="cta-shimmer inline-flex items-center gap-2 px-4 py-2.5 rounded-md bg-brand-500 text-white font-semibold text-xs hover:bg-brand-600 shadow-sm shadow-brand-500/25 active:scale-95 transition-all"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Add Service</span>
            </a>
        </div>
    </x-slot:header>

    <div class="space-y-6">
        <!-- Search & Filter Bar -->
        <div class="p-4 rounded-md bg-white border border-slate-200/90 shadow-xs flex flex-col md:flex-row gap-3 items-center justify-between">
            <form action="{{ route('admin.services.index') }}" method="GET" class="flex-1 w-full flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ $search ?? '' }}" 
                        placeholder="Search services by title or description..." 
                        class="w-full pl-10 pr-4 py-2 rounded-md border border-slate-300 bg-white text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>

                <div class="flex gap-2">
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

                    @if ($search || $status)
                        <a href="{{ route('admin.services.index') }}" class="px-3 py-2 rounded-md border border-slate-200 text-slate-600 text-xs hover:bg-slate-100 transition-colors flex items-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Services Table -->
        <div class="bg-white rounded-md border border-slate-200/90 shadow-xs overflow-hidden">
            @if ($services->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Service Title</th>
                                <th class="px-6 py-4">Icon & Features</th>
                                <th class="px-6 py-4">Call To Action</th>
                                <th class="px-6 py-4">Order</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @foreach ($services as $service)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-6 py-4 max-w-sm">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="font-bold text-slate-900 hover:text-brand-600 text-sm line-clamp-1">
                                            {{ $service->title }}
                                        </a>
                                        <div class="text-[11px] text-slate-400 line-clamp-1 mt-0.5">
                                            {{ $service->short_description }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded font-mono text-[11px] bg-slate-100 text-slate-700">
                                                {{ $service->icon ?? 'globe' }}
                                            </span>
                                            @if (!empty($service->features))
                                                <span class="text-[11px] text-slate-500">
                                                    {{ count($service->features) }} {{ Str::plural('feature', count($service->features)) }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $service->cta ?? 'Inquire Now' }}
                                    </td>
                                    <td class="px-6 py-4 font-mono text-slate-600">
                                        {{ $service->sort_order }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($service->status === 'published')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                                Published
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">
                                                Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="inline-flex items-center gap-2">
                                            <a 
                                                href="{{ route('services') }}" 
                                                target="_blank" 
                                                class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors"
                                                title="View on Public Site"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            </a>
                                            <a 
                                                href="{{ route('admin.services.edit', $service) }}" 
                                                class="p-1.5 rounded-lg text-slate-400 hover:text-brand-600 hover:bg-brand-50 transition-colors"
                                                title="Edit Service"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this service offering?');">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit" 
                                                    class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-colors"
                                                    title="Delete Service"
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

                @if ($services->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100">
                        {{ $services->links() }}
                    </div>
                @endif
            @else
                <div class="p-12 text-center">
                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-3 text-slate-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">No services found</h3>
                    <p class="text-xs text-slate-500 max-w-sm mx-auto mb-4">Start by adding your agency's software and digital marketing offerings.</p>
                    <a 
                        href="{{ route('admin.services.create') }}" 
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-md bg-brand-500 text-white font-semibold text-xs hover:bg-brand-600 transition-colors shadow-xs"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Add First Service</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>
