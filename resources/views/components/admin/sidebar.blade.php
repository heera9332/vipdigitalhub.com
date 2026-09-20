@php
    $user = Auth::user();
    $newInquiriesCount = \App\Models\FormEntry::where('status', 'new')->count();
@endphp

<!-- Desktop Collapsible Sidebar (shadcn sidebar-07) -->
<aside 
    data-admin-sidebar
    class="hidden lg:flex flex-col bg-white border-r border-slate-200/90 shrink-0 select-none transition-all duration-200 ease-in-out h-full sticky top-0 z-30 w-64"
    :class="sidebarState === 'collapsed' ? 'w-16' : 'w-64'"
    aria-label="Main Navigation"
>
    <!-- 1. Header / Team Switcher -->
    <div class="h-14 flex items-center px-3 border-b border-slate-200/80 shrink-0">
        <div 
            data-sidebar-item
            class="flex items-center w-full p-2 rounded-md hover:bg-slate-100/80 transition-colors cursor-pointer"
            :class="sidebarState === 'collapsed' ? 'justify-center px-0' : 'gap-3'"
            title="VIP Digital Hub"
        >
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-500 to-amber-500 text-white font-extrabold text-sm flex items-center justify-center shadow-xs shrink-0">
                V
            </div>

            <div data-sidebar-collapsible class="flex-1 min-w-0" x-show="sidebarState !== 'collapsed'" x-cloak>
                <div class="text-xs font-bold text-slate-900 truncate leading-tight">VIP Digital Hub</div>
                <div class="text-[11px] text-slate-500 font-mono truncate mt-0.5">Agency Suite</div>
            </div>

            <div data-sidebar-collapsible class="text-slate-400" x-show="sidebarState !== 'collapsed'" x-cloak>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- 2. NavMain: Content & Navigation Groups -->
    <div class="flex-1 overflow-y-auto overscroll-contain px-3 py-4 space-y-6">
        <!-- Platform Group -->
        <div class="space-y-1">
            <div 
                data-sidebar-collapsible
                class="px-2 pb-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400 font-mono"
                x-show="sidebarState !== 'collapsed'"
                x-cloak
            >
                Platform
            </div>

            <!-- Single Item: Dashboard -->
            <div>
                <a 
                    data-sidebar-item
                    href="{{ route('admin.dashboard') }}" 
                    class="flex items-center gap-3 px-2.5 py-2 rounded-md text-xs font-semibold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-brand-50 text-brand-600 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }}"
                    :class="sidebarState === 'collapsed' ? 'justify-center px-0' : ''"
                    title="Dashboard"
                >
                    <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-brand-600' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span data-sidebar-collapsible x-show="sidebarState !== 'collapsed'" x-cloak class="truncate">Dashboard</span>
                </a>
            </div>

            <!-- Collapsible: Articles / Blog (TipTap) -->
            <div class="space-y-1">
                <button 
                    data-sidebar-item
                    type="button" 
                    @click="toggleMenu('posts')" 
                    class="w-full flex items-center justify-between px-2.5 py-2 rounded-md text-xs font-semibold transition-all {{ request()->routeIs('admin.posts.*') ? 'text-brand-600 bg-brand-50/60' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }}"
                    :class="sidebarState === 'collapsed' ? 'justify-center px-0' : ''"
                    title="Articles & Guides"
                >
                    <div class="flex items-center gap-3 min-w-0">
                        <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.posts.*') ? 'text-brand-600' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <span data-sidebar-collapsible x-show="sidebarState !== 'collapsed'" x-cloak class="truncate">Articles</span>
                    </div>
                    <svg 
                        data-sidebar-collapsible
                        class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200 shrink-0" 
                        :class="openMenus.posts ? 'rotate-90' : ''" 
                        x-show="sidebarState !== 'collapsed'" 
                        x-cloak 
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- Submenu -->
                <div 
                    data-sidebar-collapsible
                    x-show="openMenus.posts && sidebarState !== 'collapsed'" 
                    x-cloak 
                    x-collapse 
                    class="ml-5 pl-2.5 border-l border-slate-200/90 space-y-1 my-1"
                >
                    <a 
                        href="{{ route('admin.posts.index') }}" 
                        class="block px-2 py-1.5 rounded-lg text-xs transition-colors {{ request()->routeIs('admin.posts.index') ? 'text-brand-600 font-bold bg-brand-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}"
                    >
                        All Articles
                    </a>
                    <a 
                        href="{{ route('admin.posts.create') }}" 
                        class="block px-2 py-1.5 rounded-lg text-xs transition-colors {{ request()->routeIs('admin.posts.create') ? 'text-brand-600 font-bold bg-brand-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}"
                    >
                        Write New Article
                    </a>
                </div>
            </div>

            <!-- Collapsible: Case Studies / Projects -->
            <div class="space-y-1">
                <button 
                    data-sidebar-item
                    type="button" 
                    @click="toggleMenu('projects')" 
                    class="w-full flex items-center justify-between px-2.5 py-2 rounded-md text-xs font-semibold transition-all {{ request()->routeIs('admin.projects.*') ? 'text-brand-600 bg-brand-50/60' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }}"
                    :class="sidebarState === 'collapsed' ? 'justify-center px-0' : ''"
                    title="Case Studies"
                >
                    <div class="flex items-center gap-3 min-w-0">
                        <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.projects.*') ? 'text-brand-600' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span data-sidebar-collapsible x-show="sidebarState !== 'collapsed'" x-cloak class="truncate">Case Studies</span>
                    </div>
                    <svg 
                        data-sidebar-collapsible
                        class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200 shrink-0" 
                        :class="openMenus.projects ? 'rotate-90' : ''" 
                        x-show="sidebarState !== 'collapsed'" 
                        x-cloak 
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- Submenu -->
                <div 
                    data-sidebar-collapsible
                    x-show="openMenus.projects && sidebarState !== 'collapsed'" 
                    x-cloak 
                    x-collapse 
                    class="ml-5 pl-2.5 border-l border-slate-200/90 space-y-1 my-1"
                >
                    <a 
                        href="{{ route('admin.projects.index') }}" 
                        class="block px-2 py-1.5 rounded-lg text-xs transition-colors {{ request()->routeIs('admin.projects.index') ? 'text-brand-600 font-bold bg-brand-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}"
                    >
                        All Case Studies
                    </a>
                    <a 
                        href="{{ route('admin.projects.create') }}" 
                        class="block px-2 py-1.5 rounded-lg text-xs transition-colors {{ request()->routeIs('admin.projects.create') ? 'text-brand-600 font-bold bg-brand-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}"
                    >
                        Add Case Study
                    </a>
                </div>
            </div>

            <!-- Collapsible: Services & Offerings -->
            <div class="space-y-1">
                <button 
                    data-sidebar-item
                    type="button" 
                    @click="toggleMenu('services')" 
                    class="w-full flex items-center justify-between px-2.5 py-2 rounded-md text-xs font-semibold transition-all {{ request()->routeIs('admin.services.*') ? 'text-brand-600 bg-brand-50/60' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }}"
                    :class="sidebarState === 'collapsed' ? 'justify-center px-0' : ''"
                    title="Services"
                >
                    <div class="flex items-center gap-3 min-w-0">
                        <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.services.*') ? 'text-brand-600' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <span data-sidebar-collapsible x-show="sidebarState !== 'collapsed'" x-cloak class="truncate">Services</span>
                    </div>
                    <svg 
                        data-sidebar-collapsible
                        class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200 shrink-0" 
                        :class="openMenus.services ? 'rotate-90' : ''" 
                        x-show="sidebarState !== 'collapsed'" 
                        x-cloak 
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- Submenu -->
                <div 
                    data-sidebar-collapsible
                    x-show="openMenus.services && sidebarState !== 'collapsed'" 
                    x-cloak 
                    x-collapse 
                    class="ml-5 pl-2.5 border-l border-slate-200/90 space-y-1 my-1"
                >
                    <a 
                        href="{{ route('admin.services.index') }}" 
                        class="block px-2 py-1.5 rounded-lg text-xs transition-colors {{ request()->routeIs('admin.services.index') ? 'text-brand-600 font-bold bg-brand-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}"
                    >
                        All Services
                    </a>
                    <a 
                        href="{{ route('admin.services.create') }}" 
                        class="block px-2 py-1.5 rounded-lg text-xs transition-colors {{ request()->routeIs('admin.services.create') ? 'text-brand-600 font-bold bg-brand-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}"
                    >
                        Add Service
                    </a>
                </div>
            </div>

            <!-- Single Item: Media Library -->
            <div>
                <a 
                    data-sidebar-item
                    href="{{ route('admin.media.index') }}" 
                    class="flex items-center gap-3 px-2.5 py-2 rounded-md text-xs font-semibold transition-all {{ request()->routeIs('admin.media.*') ? 'bg-brand-50 text-brand-600 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }}"
                    :class="sidebarState === 'collapsed' ? 'justify-center px-0' : ''"
                    title="Media Library"
                >
                    <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.media.*') ? 'text-brand-600' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span data-sidebar-collapsible x-show="sidebarState !== 'collapsed'" x-cloak class="truncate">Media Library</span>
                </a>
            </div>

            <!-- Collapsible: Inquiries & Leads -->
            <div class="space-y-1">
                <button 
                    data-sidebar-item
                    type="button" 
                    @click="toggleMenu('inquiries')" 
                    class="w-full flex items-center justify-between px-2.5 py-2 rounded-md text-xs font-semibold transition-all {{ request()->routeIs('admin.forms.entries.*') ? 'text-brand-600 bg-brand-50/60' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }}"
                    :class="sidebarState === 'collapsed' ? 'justify-center px-0' : ''"
                    title="Inquiries & Leads"
                >
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="relative">
                            <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.forms.entries.*') ? 'text-brand-600' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            @if ($newInquiriesCount > 0)
                                <span class="absolute -top-1 -right-1 w-2 h-2 rounded-full bg-amber-500 ring-2 ring-white" x-show="sidebarState === 'collapsed'" x-cloak></span>
                            @endif
                        </div>
                        <span data-sidebar-collapsible x-show="sidebarState !== 'collapsed'" x-cloak class="truncate">Inquiries & Leads</span>
                    </div>
                    <div data-sidebar-collapsible class="flex items-center gap-1.5" x-show="sidebarState !== 'collapsed'" x-cloak>
                        @if ($newInquiriesCount > 0)
                            <span class="px-1.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                {{ $newInquiriesCount }}
                            </span>
                        @endif
                        <svg 
                            class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200 shrink-0" 
                            :class="openMenus.inquiries ? 'rotate-90' : ''" 
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </button>

                <!-- Submenu -->
                <div 
                    data-sidebar-collapsible
                    x-show="openMenus.inquiries && sidebarState !== 'collapsed'" 
                    x-cloak 
                    x-collapse 
                    class="ml-5 pl-2.5 border-l border-slate-200/90 space-y-1 my-1"
                >
                    <a 
                        href="{{ route('admin.forms.entries.index') }}" 
                        class="block px-2 py-1.5 rounded-lg text-xs transition-colors {{ request()->routeIs('admin.forms.entries.index') && empty(request('status')) ? 'text-brand-600 font-bold bg-brand-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}"
                    >
                        All Leads
                    </a>
                    <a 
                        href="{{ route('admin.forms.entries.index', ['status' => 'new']) }}" 
                        class="flex items-center justify-between px-2 py-1.5 rounded-lg text-xs transition-colors {{ request('status') === 'new' ? 'text-brand-600 font-bold bg-brand-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}"
                    >
                        <span>New Submissions</span>
                        @if ($newInquiriesCount > 0)
                            <span class="px-1.5 py-0.2 rounded-full text-[9px] font-bold bg-amber-500 text-white">{{ $newInquiriesCount }}</span>
                        @endif
                    </a>
                    <a 
                        href="{{ route('admin.forms.entries.index', ['status' => 'in_progress']) }}" 
                        class="block px-2 py-1.5 rounded-lg text-xs transition-colors {{ request('status') === 'in_progress' ? 'text-brand-600 font-bold bg-brand-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}"
                    >
                        In Progress
                    </a>
                </div>
            </div>
        </div>

        <!-- Configuration & Resources Group -->
        <div class="space-y-1">
            <div 
                data-sidebar-collapsible
                class="px-2 pb-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400 font-mono"
                x-show="sidebarState !== 'collapsed'"
                x-cloak
            >
                Configuration
            </div>

            <div>
                <a 
                    data-sidebar-item
                    href="{{ route('admin.settings.index') }}" 
                    class="flex items-center gap-3 px-2.5 py-2 rounded-md text-xs font-semibold transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-brand-50 text-brand-600 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }}"
                    :class="sidebarState === 'collapsed' ? 'justify-center px-0' : ''"
                    title="Global Site Settings"
                >
                    <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.settings.*') ? 'text-brand-600' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span data-sidebar-collapsible x-show="sidebarState !== 'collapsed'" x-cloak class="truncate">Site Settings</span>
                </a>
            </div>

            <div>
                <a 
                    data-sidebar-item
                    href="{{ route('home') }}" 
                    target="_blank" 
                    class="flex items-center gap-3 px-2.5 py-2 rounded-md text-xs font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-100/80 transition-all"
                    :class="sidebarState === 'collapsed' ? 'justify-center px-0' : ''"
                    title="View Live Website"
                >
                    <svg class="w-4 h-4 text-brand-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    <span data-sidebar-collapsible x-show="sidebarState !== 'collapsed'" x-cloak class="truncate">Live Website</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 3. NavUser: User Footer & Popover Dropdown -->
    <div class="p-2 border-t border-slate-200/80 relative shrink-0" x-data="{ userDropdownOpen: false }">
        <button 
            data-sidebar-item
            type="button" 
            @click="userDropdownOpen = !userDropdownOpen" 
            class="flex items-center w-full p-2 rounded-md hover:bg-slate-100/80 transition-colors text-left"
            :class="sidebarState === 'collapsed' ? 'justify-center px-0' : 'gap-3'"
            title="{{ $user?->name ?? 'Admin Profile' }}"
        >
            <div class="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-xs">
                {{ substr($user?->name ?? 'A', 0, 1) }}
            </div>

            <div data-sidebar-collapsible class="flex-1 min-w-0" x-show="sidebarState !== 'collapsed'" x-cloak>
                <div class="text-xs font-bold text-slate-900 truncate leading-tight">{{ $user?->name ?? 'Admin' }}</div>
                <div class="text-[11px] text-slate-400 font-mono truncate mt-0.5">{{ $user?->email ?? 'admin@vipdigitalhub.com' }}</div>
            </div>

            <div data-sidebar-collapsible class="text-slate-400" x-show="sidebarState !== 'collapsed'" x-cloak>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                </svg>
            </div>
        </button>

        <!-- User Popover Menu -->
        <div 
            x-show="userDropdownOpen" 
            @click.outside="userDropdownOpen = false" 
            x-cloak 
            x-transition:enter="transition ease-out duration-100" 
            x-transition:enter-start="transform opacity-0 scale-95" 
            x-transition:enter-end="transform opacity-100 scale-100" 
            class="absolute bottom-16 left-2 right-2 bg-white rounded-md border border-slate-200 shadow-xl p-1.5 space-y-1 z-50 text-xs"
            :class="sidebarState === 'collapsed' ? 'w-56 left-16' : ''"
        >
            <div class="px-3 py-2 border-b border-slate-100">
                <div class="font-bold text-slate-900 truncate">{{ $user?->name ?? 'Admin User' }}</div>
                <div class="text-[11px] text-slate-400 font-mono truncate">{{ $user?->email ?? '' }}</div>
            </div>

            <a 
                href="{{ route('admin.settings.index') }}" 
                class="flex items-center gap-2 px-3 py-2 rounded-lg text-slate-700 hover:bg-slate-100 hover:text-slate-900 transition-colors"
            >
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/></svg>
                <span>Account Settings</span>
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button 
                    type="submit" 
                    class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-rose-600 hover:bg-rose-50 hover:text-rose-700 transition-colors text-left"
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Sign Out</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Mobile Drawer Sidebar (shadcn mobile sheet) -->
<div 
    x-show="mobileOpen" 
    x-cloak 
    class="lg:hidden fixed inset-0 z-50 flex"
>
    <!-- Backdrop Overlay -->
    <div 
        x-show="mobileOpen" 
        x-transition:enter="transition-opacity ease-out duration-200" 
        x-transition:enter-start="opacity-0" 
        x-transition:enter-end="opacity-100" 
        x-transition:leave="transition-opacity ease-in duration-150" 
        x-transition:leave-start="opacity-100" 
        x-transition:leave-end="opacity-0" 
        @click="mobileOpen = false" 
        class="fixed inset-0 bg-slate-950/50 backdrop-blur-xs"
    ></div>

    <!-- Drawer Panel -->
    <div 
        x-show="mobileOpen" 
        x-transition:enter="transition ease-out duration-200 transform" 
        x-transition:enter-start="-translate-x-full" 
        x-transition:enter-end="translate-x-0" 
        x-transition:leave="transition ease-in duration-150 transform" 
        x-transition:leave-start="translate-x-0" 
        x-transition:leave-end="-translate-x-full" 
        class="relative flex-1 flex flex-col max-w-xs w-full bg-white shadow-2xl"
    >
        <div class="h-16 flex items-center justify-between px-4 border-b border-slate-200">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-500 to-amber-500 text-white font-extrabold text-sm flex items-center justify-center shadow-xs">
                    V
                </div>
                <div>
                    <div class="text-xs font-bold text-slate-900">VIP Digital Hub</div>
                    <div class="text-[10px] text-slate-500 font-mono">Admin Navigation</div>
                </div>
            </div>
            <button @click="mobileOpen = false" class="p-2 text-slate-400 hover:text-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto p-4 space-y-4 text-xs">
            <div class="space-y-1">
                <div class="px-2 text-[10px] font-bold uppercase tracking-wider text-slate-400 font-mono">Navigation</div>
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-brand-50 text-brand-600' : 'text-slate-700 hover:bg-slate-100' }}">Dashboard</a>
                <a href="{{ route('admin.posts.index') }}" class="block px-3 py-2 rounded-md font-semibold {{ request()->routeIs('admin.posts.*') ? 'bg-brand-50 text-brand-600' : 'text-slate-700 hover:bg-slate-100' }}">Articles</a>
                <a href="{{ route('admin.projects.index') }}" class="block px-3 py-2 rounded-md font-semibold {{ request()->routeIs('admin.projects.*') ? 'bg-brand-50 text-brand-600' : 'text-slate-700 hover:bg-slate-100' }}">Case Studies</a>
                <a href="{{ route('admin.services.index') }}" class="block px-3 py-2 rounded-md font-semibold {{ request()->routeIs('admin.services.*') ? 'bg-brand-50 text-brand-600' : 'text-slate-700 hover:bg-slate-100' }}">Services</a>
                <a href="{{ route('admin.media.index') }}" class="block px-3 py-2 rounded-md font-semibold {{ request()->routeIs('admin.media.*') ? 'bg-brand-50 text-brand-600' : 'text-slate-700 hover:bg-slate-100' }}">Media Library</a>
                <a href="{{ route('admin.forms.entries.index') }}" class="flex items-center justify-between px-3 py-2 rounded-md font-semibold {{ request()->routeIs('admin.forms.entries.*') ? 'bg-brand-50 text-brand-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    <span>Inquiries & Leads</span>
                    @if ($newInquiriesCount > 0)
                        <span class="px-1.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-500 text-white">{{ $newInquiriesCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.settings.index') }}" class="block px-3 py-2 rounded-md font-semibold {{ request()->routeIs('admin.settings.*') ? 'bg-brand-50 text-brand-600' : 'text-slate-700 hover:bg-slate-100' }}">Site Settings</a>
                <a href="{{ route('home') }}" target="_blank" class="block px-3 py-2 rounded-md font-semibold text-brand-600 hover:bg-slate-100">View Live Website &rarr;</a>
            </div>
        </div>

        <div class="p-4 border-t border-slate-200">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-md border border-rose-200 text-rose-600 font-semibold text-xs hover:bg-rose-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Sign Out</span>
                </button>
            </form>
        </div>
    </div>
</div>
