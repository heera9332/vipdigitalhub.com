<x-layouts.admin :title="'Inquiry from ' . $entry->name">
    <x-slot:header>
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <a href="{{ route('admin.forms.entries.index') }}" class="hover:text-brand-600 transition-colors">Inquiries</a>
                <span>/</span>
                <span class="text-slate-900 font-semibold">{{ $entry->name }}</span>
            </div>
            <a 
                href="{{ route('admin.forms.entries.index') }}" 
                class="px-3 py-1.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors"
            >
                &larr; Back to Inquiries
            </a>
        </div>
    </x-slot:header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Inquiry Message & Scope -->
        <div class="lg:col-span-8 space-y-6">
            <!-- Message Details -->
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/90 shadow-xs space-y-6">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono uppercase tracking-wider text-slate-400 font-semibold">Service Requirement</span>
                        <span class="text-xs text-slate-400">{{ $entry->created_at->format('F d, Y · h:i A') }}</span>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-950 mt-1">
                        {{ $entry->service ?? 'General Software Project' }}
                    </h2>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Estimated Budget</div>
                        <div class="text-base font-bold text-brand-600 mt-0.5">{{ $entry->budget ?? 'Not Specified' }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Company / Org</div>
                        <div class="text-base font-bold text-slate-900 mt-0.5">{{ $entry->company ?? 'Individual Client' }}</div>
                    </div>
                </div>

                <div class="space-y-2">
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-400">Project Scope & Message</h3>
                    <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 text-slate-800 text-sm sm:text-base leading-relaxed whitespace-pre-line font-normal">
                        {{ $entry->message }}
                    </div>
                </div>

                <!-- Quick Action Buttons -->
                <div class="pt-4 border-t border-slate-100 flex flex-wrap items-center gap-3">
                    <a 
                        href="mailto:{{ $entry->email }}?subject={{ urlencode('Regarding your inquiry with VIP Digital Hub: ' . ($entry->service ?? 'Project Discussion')) }}" 
                        class="cta-shimmer inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-semibold text-xs shadow-sm shadow-brand-500/25 transition-all"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Reply by Email</span>
                    </a>

                    @if ($entry->phone)
                        <a 
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $entry->phone) }}" 
                            target="_blank" 
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs transition-all shadow-xs"
                        >
                            <span>WhatsApp Client</span>
                        </a>

                        <a 
                            href="tel:{{ preg_replace('/[^0-9+]/', '', $entry->phone) }}" 
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold text-xs transition-all"
                        >
                            <span>Call {{ $entry->phone }}</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar: Status & Technical Meta -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Lead Status Manager -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/90 shadow-xs space-y-4">
                <h3 class="text-sm font-bold text-slate-950">Lead Status Workflow</h3>

                <form action="{{ route('admin.forms.entries.status', $entry) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="status" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Current Lifecycle Status
                        </label>
                        <select 
                            name="status" 
                            id="status" 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                            <option value="new" {{ $entry->status === 'new' ? 'selected' : '' }}>New (Awaiting Review)</option>
                            <option value="contacted" {{ $entry->status === 'contacted' ? 'selected' : '' }}>Contacted (Initial Reachout)</option>
                            <option value="in_progress" {{ $entry->status === 'in_progress' ? 'selected' : '' }}>In Progress (Proposal Sent)</option>
                            <option value="closed" {{ $entry->status === 'closed' ? 'selected' : '' }}>Closed (Archived / Won)</option>
                        </select>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-slate-900 text-white font-semibold text-xs hover:bg-slate-800 transition-colors"
                    >
                        Update Lead Status
                    </button>
                </form>
            </div>

            <!-- Client Contact Information -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/90 shadow-xs space-y-4 text-xs">
                <h3 class="text-sm font-bold text-slate-950">Client Details</h3>

                <div class="space-y-3 divide-y divide-slate-100">
                    <div class="pt-2">
                        <span class="text-slate-400 font-semibold uppercase text-[10px]">Full Name</span>
                        <div class="font-bold text-slate-900 text-sm mt-0.5">{{ $entry->name }}</div>
                    </div>

                    <div class="pt-2">
                        <span class="text-slate-400 font-semibold uppercase text-[10px]">Email Address</span>
                        <div class="font-medium text-slate-800 mt-0.5 break-all">
                            <a href="mailto:{{ $entry->email }}" class="text-brand-600 hover:underline">{{ $entry->email }}</a>
                        </div>
                    </div>

                    <div class="pt-2">
                        <span class="text-slate-400 font-semibold uppercase text-[10px]">Phone Number</span>
                        <div class="font-medium text-slate-800 mt-0.5">
                            {{ $entry->phone ?? 'Not provided' }}
                        </div>
                    </div>

                    <div class="pt-2">
                        <span class="text-slate-400 font-semibold uppercase text-[10px]">Company</span>
                        <div class="font-medium text-slate-800 mt-0.5">
                            {{ $entry->company ?? '—' }}
                        </div>
                    </div>

                    <div class="pt-2">
                        <span class="text-slate-400 font-semibold uppercase text-[10px]">Source Form</span>
                        <div class="font-mono text-slate-600 mt-0.5">
                            {{ $entry->form_name ?? 'contact' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Technical Tracking Data -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/90 shadow-xs space-y-3 text-xs text-slate-600">
                <h3 class="text-sm font-bold text-slate-950">Technical Metadata</h3>
                <div>
                    <span class="text-slate-400 font-semibold uppercase text-[10px]">IP Address:</span>
                    <span class="font-mono text-slate-700 ml-1">{{ $entry->ip_address ?? '—' }}</span>
                </div>
                <div>
                    <span class="text-slate-400 font-semibold uppercase text-[10px]">User Agent:</span>
                    <p class="font-mono text-[11px] text-slate-500 break-all mt-0.5">{{ $entry->user_agent ?? '—' }}</p>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="bg-white p-6 rounded-3xl border border-rose-100 shadow-xs">
                <form action="{{ route('admin.forms.entries.destroy', $entry) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this inquiry?');">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="w-full px-4 py-2.5 rounded-xl border border-rose-200 text-rose-600 font-semibold text-xs hover:bg-rose-50 transition-colors"
                    >
                        Permanently Delete Inquiry
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
