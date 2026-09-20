<x-layouts.admin title="Dashboard">
    <x-slot:header>
        <div>
            <h1 class="text-xl font-bold text-slate-900 tracking-tight">Executive Dashboard</h1>
            <p class="text-xs text-slate-500 mt-0.5">Overview of agency inquiries, published engineering guides, and portfolio projects.</p>
        </div>
    </x-slot:header>

    <div class="space-y-8">
        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Inquiries Card -->
            <div class="p-5 rounded-md border border-slate-200 bg-white shadow-xs flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Project Inquiries</div>
                    <div class="text-3xl font-extrabold text-slate-950 mt-1">{{ $stats['totalInquiries'] }}</div>
                    <div class="text-xs font-medium text-amber-600 mt-1">
                        {{ $stats['newInquiries'] }} new / unreviewed
                    </div>
                </div>
                <div class="w-12 h-12 rounded-md bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
            </div>

            <!-- Published Posts Card -->
            <div class="p-5 rounded-md border border-slate-200 bg-white shadow-xs flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Knowledge Base</div>
                    <div class="text-3xl font-extrabold text-slate-950 mt-1">{{ $stats['totalPosts'] }}</div>
                    <div class="text-xs font-medium text-emerald-600 mt-1">
                        {{ $stats['publishedPosts'] }} published articles
                    </div>
                </div>
                <div class="w-12 h-12 rounded-md bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
            </div>

            <!-- Projects Card -->
            <div class="p-5 rounded-md border border-slate-200 bg-white shadow-xs flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Client Work</div>
                    <div class="text-3xl font-extrabold text-slate-950 mt-1">{{ $stats['totalProjects'] }}</div>
                    <div class="text-xs font-medium text-brand-600 mt-1">
                        {{ $stats['featuredProjects'] }} featured platforms
                    </div>
                </div>
                <div class="w-12 h-12 rounded-md bg-brand-50 text-brand-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
            </div>

            <!-- Services Card -->
            <div class="p-5 rounded-md border border-slate-200 bg-white shadow-xs flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Services Catalog</div>
                    <div class="text-3xl font-extrabold text-slate-950 mt-1">{{ $stats['totalServices'] }}</div>
                    <div class="text-xs font-medium text-indigo-600 mt-1">
                        {{ $stats['publishedServices'] }} active offerings
                    </div>
                </div>
                <div class="w-12 h-12 rounded-md bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
            </div>
        </div>

        <!-- Two-column tables: Recent Inquiries & Recent Posts -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Recent Inquiries -->
            <div class="lg:col-span-7 bg-white rounded-md border border-slate-200/90 shadow-xs overflow-hidden">
                <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Recent Client Inquiries</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Prospective project submissions from website forms</p>
                    </div>
                    <a href="{{ route('admin.forms.entries.index') }}" class="text-xs font-semibold text-brand-600 hover:text-brand-700">
                        View All ({{ $stats['totalInquiries'] }})
                    </a>
                </div>

                @if ($recentInquiries->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider">
                                <tr>
                                    <th class="px-5 py-3">Lead / Company</th>
                                    <th class="px-5 py-3">Service</th>
                                    <th class="px-5 py-3">Status</th>
                                    <th class="px-5 py-3 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                @foreach ($recentInquiries as $entry)
                                    <tr class="hover:bg-slate-50/60 transition-colors">
                                        <td class="px-5 py-3.5">
                                            <div class="font-bold text-slate-900">{{ $entry->name }}</div>
                                            <div class="text-slate-500 text-[11px]">{{ $entry->email }}</div>
                                        </td>
                                        <td class="px-5 py-3.5">
                                            <span class="font-medium text-slate-800">{{ $entry->service ?? 'General' }}</span>
                                        </td>
                                        <td class="px-5 py-3.5">
                                            @if ($entry->status === 'new')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                                    New
                                                </span>
                                            @elseif ($entry->status === 'contacted')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">
                                                    Contacted
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700">
                                                    {{ ucfirst($entry->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-3.5 text-right">
                                            <a href="{{ route('admin.forms.entries.show', $entry) }}" class="text-xs font-semibold text-brand-600 hover:text-brand-700">
                                                Review &rarr;
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-xs text-slate-400">
                        No inquiries received yet.
                    </div>
                @endif
            </div>

            <!-- Recent Posts -->
            <div class="lg:col-span-5 bg-white rounded-md border border-slate-200/90 shadow-xs overflow-hidden">
                <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Recent Articles</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Written in TipTap rich-text</p>
                    </div>
                    <a href="{{ route('admin.posts.index') }}" class="text-xs font-semibold text-brand-600 hover:text-brand-700">
                        Manage All
                    </a>
                </div>

                @if ($recentPosts->isNotEmpty())
                    <div class="divide-y divide-slate-100">
                        @foreach ($recentPosts as $post)
                            <div class="p-4 hover:bg-slate-50/60 transition-colors flex items-center justify-between">
                                <div class="pr-3 overflow-hidden">
                                    <div class="text-xs font-bold text-slate-900 truncate hover:text-brand-600">
                                        <a href="{{ route('admin.posts.edit', $post) }}">{{ $post->title }}</a>
                                    </div>
                                    <div class="text-[11px] text-slate-400 mt-0.5 flex items-center gap-2">
                                        <span>{{ $post->category }}</span>
                                        <span>·</span>
                                        <span class="{{ $post->status === 'published' ? 'text-emerald-600 font-semibold' : 'text-slate-400' }}">
                                            {{ ucfirst($post->status) }}
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('admin.posts.edit', $post) }}" class="p-1.5 rounded-lg border border-slate-200 text-slate-500 hover:text-brand-600 hover:border-brand-300 transition-colors shrink-0" title="Edit Post">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-8 text-center text-xs text-slate-400">
                        No articles published yet.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.admin>
