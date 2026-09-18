<x-layouts.admin title="Inquiries & Leads">
    <x-slot:header>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Client Inquiries & RFP Leads</h1>
                <p class="text-xs text-slate-500 mt-0.5">Project proposals and inquiry submissions received through frontend contact forms.</p>
            </div>
        </div>
    </x-slot:header>

    <div class="space-y-6">
        <!-- Status Tabs & Filter -->
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
            <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                <a 
                    href="{{ route('admin.forms.entries.index') }}" 
                    class="px-3 py-1.5 rounded-xl text-xs font-semibold transition-all {{ empty($status) ? 'bg-brand-500 text-white shadow-xs' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}"
                >
                    All Leads ({{ $statusCounts['all'] }})
                </a>
                <a 
                    href="{{ route('admin.forms.entries.index', ['status' => 'new']) }}" 
                    class="px-3 py-1.5 rounded-xl text-xs font-semibold transition-all {{ $status === 'new' ? 'bg-amber-500 text-white shadow-xs' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}"
                >
                    New ({{ $statusCounts['new'] }})
                </a>
                <a 
                    href="{{ route('admin.forms.entries.index', ['status' => 'contacted']) }}" 
                    class="px-3 py-1.5 rounded-xl text-xs font-semibold transition-all {{ $status === 'contacted' ? 'bg-blue-600 text-white shadow-xs' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}"
                >
                    Contacted ({{ $statusCounts['contacted'] }})
                </a>
                <a 
                    href="{{ route('admin.forms.entries.index', ['status' => 'in_progress']) }}" 
                    class="px-3 py-1.5 rounded-xl text-xs font-semibold transition-all {{ $status === 'in_progress' ? 'bg-purple-600 text-white shadow-xs' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}"
                >
                    In Progress ({{ $statusCounts['in_progress'] }})
                </a>
                <a 
                    href="{{ route('admin.forms.entries.index', ['status' => 'closed']) }}" 
                    class="px-3 py-1.5 rounded-xl text-xs font-semibold transition-all {{ $status === 'closed' ? 'bg-slate-800 text-white shadow-xs' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}"
                >
                    Closed ({{ $statusCounts['closed'] }})
                </a>
            </div>

            <!-- Search -->
            <form action="{{ route('admin.forms.entries.index') }}" method="GET" class="w-full sm:w-72">
                <div class="relative">
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ $search ?? '' }}" 
                        placeholder="Search lead or company..." 
                        class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-300 bg-white text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </form>
        </div>

        <!-- Inquiries Table -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs overflow-hidden">
            @if ($entries->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Client / Company</th>
                                <th class="px-6 py-4">Service & Budget</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Received</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @foreach ($entries as $entry)
                                <tr class="hover:bg-slate-50/60 transition-colors {{ $entry->status === 'new' ? 'bg-amber-50/20' : '' }}">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.forms.entries.show', $entry) }}" class="font-bold text-slate-900 hover:text-brand-600 text-sm">
                                            {{ $entry->name }}
                                        </a>
                                        <div class="text-[11px] text-slate-500 mt-0.5">
                                            {{ $entry->email }}
                                            @if ($entry->company)
                                                · <span class="font-medium text-slate-700">{{ $entry->company }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-slate-900">{{ $entry->service ?? 'General Software' }}</div>
                                        <div class="text-[11px] text-brand-600 font-mono font-medium">{{ $entry->budget ?? 'Flexible' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($entry->status === 'new')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                                New Lead
                                            </span>
                                        @elseif ($entry->status === 'contacted')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">
                                                Contacted
                                            </span>
                                        @elseif ($entry->status === 'in_progress')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-purple-100 text-purple-800">
                                                In Progress
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700">
                                                Closed
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 whitespace-nowrap">
                                        {{ $entry->created_at->format('M d, Y · h:i A') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a 
                                                href="{{ route('admin.forms.entries.show', $entry) }}" 
                                                class="px-3 py-1.5 rounded-lg bg-slate-100 text-slate-700 hover:bg-brand-500 hover:text-white font-semibold text-xs transition-colors"
                                            >
                                                View Inquiry &rarr;
                                            </a>
                                            <form action="{{ route('admin.forms.entries.destroy', $entry) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this inquiry record?');">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit" 
                                                    class="p-1.5 rounded-lg border border-slate-200 text-slate-400 hover:text-rose-600 hover:border-rose-200 transition-colors"
                                                    title="Delete Entry"
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
                    {{ $entries->links() }}
                </div>
            @else
                <div class="p-12 text-center space-y-3">
                    <svg class="w-12 h-12 text-slate-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <p class="text-sm font-semibold text-slate-800">No inquiry submissions found.</p>
                    <p class="text-xs text-slate-400">Inquiries submitted from the frontend contact form will appear here in real-time.</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>
