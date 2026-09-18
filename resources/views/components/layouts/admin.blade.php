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

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-slate-900 bg-slate-100 selection:bg-brand-500 selection:text-white" x-data="{ mobileMenuOpen: false }">
    <div class="min-h-full flex flex-col lg:flex-row">
        <!-- Sidebar Navigation (Desktop) -->
        <aside class="hidden lg:flex lg:flex-col lg:w-64 bg-slate-900 text-slate-300 shrink-0 border-r border-slate-800">
            <!-- Brand -->
            <div class="h-16 flex items-center px-6 border-b border-slate-800/80 bg-slate-950/60">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-xl bg-gradient-to-br from-brand-500 to-amber-500 text-white font-extrabold text-sm flex items-center justify-center shadow-md shadow-brand-500/25">
                        V
                    </span>
                    <div class="flex flex-col">
                        <span class="font-extrabold text-sm tracking-tight text-white leading-none">VIP Digital Hub</span>
                        <span class="text-[10px] text-brand-400 font-mono tracking-wider uppercase mt-1">Admin Panel</span>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-3 py-6 space-y-1.5 overflow-y-auto">
                <a 
                    href="{{ route('admin.dashboard') }}" 
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-brand-500 text-white shadow-sm shadow-brand-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }}"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                <a 
                    href="{{ route('admin.posts.index') }}" 
                    class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.posts.*') ? 'bg-brand-500 text-white shadow-sm shadow-brand-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }}"
                >
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <span>Articles (TipTap)</span>
                    </div>
                </a>

                <a 
                    href="{{ route('admin.projects.index') }}" 
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.projects.*') ? 'bg-brand-500 text-white shadow-sm shadow-brand-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }}"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>Case Studies</span>
                </a>

                <a 
                    href="{{ route('admin.forms.entries.index') }}" 
                    class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.forms.entries.*') ? 'bg-brand-500 text-white shadow-sm shadow-brand-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }}"
                >
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Inquiries & Leads</span>
                    </div>
                    @php
                        $newInquiriesCount = \App\Models\FormEntry::where('status', 'new')->count();
                    @endphp
                    @if ($newInquiriesCount > 0)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-400 text-slate-950">
                            {{ $newInquiriesCount }}
                        </span>
                    @endif
                </a>

                <a 
                    href="{{ route('admin.settings.index') }}" 
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-brand-500 text-white shadow-sm shadow-brand-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }}"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Site Settings</span>
                </a>

                <div class="pt-4 mt-4 border-t border-slate-800">
                    <a 
                        href="{{ route('home') }}" 
                        target="_blank" 
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800/70 transition-all"
                    >
                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span>View Live Website</span>
                    </a>
                </div>
            </nav>

            <!-- User footer -->
            <div class="p-4 border-t border-slate-800 bg-slate-950/40 flex items-center justify-between">
                <div class="flex items-center gap-3 overflow-hidden">
                    <div class="w-8 h-8 rounded-lg bg-brand-500 text-white flex items-center justify-center font-bold text-xs shrink-0">
                        {{ substr(Auth::user()?->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="truncate">
                        <div class="text-xs font-semibold text-white truncate">{{ Auth::user()?->name ?? 'Admin' }}</div>
                        <div class="text-[11px] text-slate-400 truncate">{{ Auth::user()?->email ?? '' }}</div>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="p-2 text-slate-400 hover:text-rose-400 transition-colors" title="Sign Out">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top Mobile Bar -->
            <header class="lg:hidden h-16 bg-slate-900 text-white flex items-center justify-between px-4 border-b border-slate-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-brand-500 text-white font-extrabold text-xs flex items-center justify-center">V</span>
                    <span class="font-bold text-sm tracking-tight">VIP Admin</span>
                </a>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-slate-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </header>

            <!-- Mobile Nav Dropdown -->
            <div x-show="mobileMenuOpen" x-cloak class="lg:hidden bg-slate-900 border-b border-slate-800 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-slate-800">Dashboard</a>
                <a href="{{ route('admin.posts.index') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-slate-800">Articles (TipTap)</a>
                <a href="{{ route('admin.projects.index') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-slate-800">Case Studies</a>
                <a href="{{ route('admin.forms.entries.index') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-slate-800">Inquiries</a>
                <a href="{{ route('admin.settings.index') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-slate-800">Site Settings</a>
                <a href="{{ route('home') }}" target="_blank" class="block px-3 py-2 rounded-lg text-sm text-brand-400 hover:bg-slate-800">Live Website</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="pt-2 border-t border-slate-800">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-sm text-rose-400 hover:bg-slate-800">Sign Out</button>
                </form>
            </div>

            <!-- Page Header / Breadcrumb Topbar -->
            <div class="bg-white border-b border-slate-200/90 px-6 sm:px-8 py-4 flex items-center justify-between">
                <div>
                    {{ $header ?? '' }}
                </div>
                <div class="hidden sm:flex items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition-all">
                        <svg class="w-3.5 h-3.5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span>View Website</span>
                    </a>
                </div>
            </div>

            <!-- Flash Alerts -->
            <div class="px-6 sm:px-8 pt-6">
                @if (session('success'))
                    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium flex items-center gap-3 shadow-xs">
                        <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium flex items-center gap-3 shadow-xs">
                        <svg class="w-5 h-5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if (session('status'))
                    <div class="p-4 rounded-2xl bg-blue-50 border border-blue-200 text-blue-800 text-sm font-medium flex items-center gap-3 shadow-xs">
                        <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif
            </div>

            <!-- Page Body -->
            <main class="flex-1 p-6 sm:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
