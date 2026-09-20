@props([
    'title' => 'Admin Panel — VIP Digital Hub',
    'header' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} — VIP Digital Hub Admin</title>

    <!-- Immediate synchronous sidebar state detection to prevent initial layout shift / flicker -->
    <script>
        (function () {
            try {
                var state = localStorage.getItem('sidebar_state');
                if (state === 'collapsed') {
                    document.documentElement.classList.add('sidebar-collapsed');
                } else {
                    document.documentElement.classList.add('sidebar-expanded');
                }
            } catch (e) {}
        })();
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body 
    class="h-full overflow-hidden font-sans antialiased text-slate-900 bg-slate-100 selection:bg-brand-500 selection:text-white preload-transitions"
    x-data="{
        sidebarState: document.documentElement.classList.contains('sidebar-collapsed') ? 'collapsed' : 'expanded',
        mobileOpen: false,
        openMenus: {
            posts: {{ request()->routeIs('admin.posts.*') ? 'true' : 'false' }},
            projects: {{ request()->routeIs('admin.projects.*') ? 'true' : 'false' }},
            inquiries: {{ request()->routeIs('admin.forms.entries.*') ? 'true' : 'false' }},
        },
        toggleSidebar() {
            this.sidebarState = this.sidebarState === 'expanded' ? 'collapsed' : 'expanded';
            localStorage.setItem('sidebar_state', this.sidebarState);
            if (this.sidebarState === 'collapsed') {
                document.documentElement.classList.add('sidebar-collapsed');
                document.documentElement.classList.remove('sidebar-expanded');
            } else {
                document.documentElement.classList.remove('sidebar-collapsed');
                document.documentElement.classList.add('sidebar-expanded');
            }
        },
        toggleMenu(name) {
            if (this.sidebarState === 'collapsed') {
                this.sidebarState = 'expanded';
                localStorage.setItem('sidebar_state', 'expanded');
                document.documentElement.classList.remove('sidebar-collapsed');
                document.documentElement.classList.add('sidebar-expanded');
                this.openMenus[name] = true;
            } else {
                this.openMenus[name] = !this.openMenus[name];
            }
        }
    }"
    @keydown.window.ctrl.b.prevent="toggleSidebar()"
    @keydown.window.meta.b.prevent="toggleSidebar()"
>
    <div class="h-screen flex flex-row overflow-hidden">
        <!-- shadcn sidebar-07 Component -->
        <x-admin.sidebar />

        <!-- Main Workspace Area -->
        <div class="flex-1 flex flex-col min-w-0 h-full overflow-y-auto overscroll-contain">
            <!-- shadcn Header with SidebarTrigger & Breadcrumbs -->
            <header class="h-14 bg-white border-b border-slate-200/90 px-4 sm:px-6 flex items-center justify-between shrink-0 sticky top-0 z-20">
                <!-- Left: SidebarTrigger & Breadcrumb Trail -->
                <div class="flex items-center gap-3">
                    <!-- Mobile Trigger -->
                    <button 
                        type="button" 
                        @click="mobileOpen = true" 
                        class="lg:hidden p-2 rounded-md text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition-colors"
                        title="Open Mobile Navigation"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <!-- Desktop shadcn SidebarTrigger -->
                    <button 
                        type="button" 
                        @click="toggleSidebar()" 
                        class="hidden lg:inline-flex items-center justify-center p-2 rounded-md text-slate-500 hover:text-slate-900 hover:bg-slate-100/90 transition-colors"
                        title="Toggle Sidebar (Ctrl+B)"
                    >
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                            <line x1="9" y1="3" x2="9" y2="21"/>
                        </svg>
                    </button>

                    <!-- Vertical Separator -->
                    <div class="hidden sm:block h-4 w-px bg-slate-200"></div>

                    <!-- Breadcrumbs -->
                    <nav class="flex items-center gap-1.5 text-xs text-slate-500 overflow-hidden">
                        <a href="{{ route('admin.dashboard') }}" class="font-medium text-slate-400 hover:text-slate-800 transition-colors shrink-0">
                            Admin
                        </a>
                        <svg class="w-3.5 h-3.5 text-slate-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="font-semibold text-slate-800 truncate">
                            {{ $title }}
                        </span>
                    </nav>

                    <span class="hidden xl:inline-flex items-center px-1.5 py-0.5 rounded border border-slate-200 bg-slate-50 text-[10px] text-slate-400 font-mono" title="Shortcut to toggle sidebar">
                        ⌘B
                    </span>
                </div>

                <!-- Right Header Actions -->
                <div class="flex items-center gap-3">
                    <a 
                        href="{{ route('admin.posts.create') }}" 
                        class="hidden md:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md bg-brand-50 hover:bg-brand-100 text-brand-700 font-semibold text-xs transition-colors"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>New Post</span>
                    </a>

                    <a 
                        href="{{ route('home') }}" 
                        target="_blank" 
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-xs"
                    >
                        <svg class="w-3.5 h-3.5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span class="hidden sm:inline">Live Website</span>
                    </a>
                </div>
            </header>

            <!-- Custom Slot Header if provided -->
            @if ($header)
                <div class="bg-white border-b border-slate-200/90 px-6 sm:px-8 py-4">
                    {{ $header }}
                </div>
            @endif

            <!-- Flash Alerts Notification System -->
            <div class="px-6 sm:px-8 pt-6">
                @if (session('success'))
                    <div class="p-4 rounded-md bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium flex items-center gap-3 shadow-xs">
                        <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 rounded-md bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium flex items-center gap-3 shadow-xs">
                        <svg class="w-5 h-5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if (session('status'))
                    <div class="p-4 rounded-md bg-blue-50 border border-blue-200 text-blue-800 text-sm font-medium flex items-center gap-3 shadow-xs">
                        <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif
            </div>

            <!-- Main Work Content -->
            <main class="flex-1 p-6 sm:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Enable smooth transitions only AFTER initial paint and hydration -->
    <script>
        (function () {
            function enableTransitions() {
                requestAnimationFrame(function () {
                    requestAnimationFrame(function () {
                        document.body.classList.remove('preload-transitions');
                    });
                });
            }
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', enableTransitions);
            } else {
                enableTransitions();
            }
        })();
    </script>
</body>
</html>
