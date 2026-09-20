<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-950">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Sign In — VIP Digital Hub</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-slate-100 flex items-center justify-center p-4 selection:bg-brand-500 selection:text-white relative overflow-hidden">
    <!-- Ambient glowing backgrounds -->
    <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-brand-600/15 blur-3xl pointer-events-none animate-float-slow"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full bg-amber-500/15 blur-3xl pointer-events-none animate-pulse-glow"></div>

    <div class="w-full max-w-md relative z-10 space-y-6">
        <!-- Logo & Header -->
        <div class="text-center space-y-2">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-md bg-gradient-to-br from-brand-500 to-amber-500 text-white font-extrabold text-2xl shadow-lg shadow-brand-500/30">
                V
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                VIP Digital Hub
            </h1>
            <p class="text-xs text-slate-400 font-medium">
                Internal Administrative Operations & Content Hub
            </p>
        </div>

        <!-- Login Card -->
        <div class="rounded-md border border-slate-800 bg-slate-900/90 backdrop-blur-xl p-7 sm:p-8 shadow-2xl space-y-5">
            @if (session('status'))
                <div class="p-3.5 rounded-md bg-blue-500/10 border border-blue-500/30 text-blue-300 text-xs font-medium">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-3.5 rounded-md bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Admin Email
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', 'admin@vipdigitalhub.com') }}" 
                        required 
                        autofocus
                        class="w-full px-4 py-3 rounded-md border border-slate-700 bg-slate-950 text-sm text-white placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-brand-500/50 focus:border-brand-500 transition-all shadow-xs"
                        placeholder="admin@vipdigitalhub.com"
                    >
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Password
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        value="password"
                        required 
                        class="w-full px-4 py-3 rounded-md border border-slate-700 bg-slate-950 text-sm text-white placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-brand-500/50 focus:border-brand-500 transition-all shadow-xs"
                        placeholder="••••••••"
                    >
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-400 hover:text-slate-300">
                        <input type="checkbox" name="remember" value="1" checked class="rounded border-slate-700 text-brand-500 focus:ring-brand-500 bg-slate-950">
                        <span>Keep me signed in</span>
                    </label>
                </div>

                <button 
                    type="submit" 
                    class="cta-shimmer w-full mt-2 inline-flex items-center justify-center px-5 py-3.5 rounded-md font-semibold text-sm text-white bg-brand-500 hover:bg-brand-600 active:scale-[0.98] shadow-lg shadow-brand-500/25 hover:shadow-brand-500/40 transition-all"
                >
                    <span>Sign In to Admin Panel</span>
                    <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>

            <div class="pt-2 border-t border-slate-800/80 text-center">
                <span class="text-[11px] text-slate-500">
                    Default credentials: <strong class="text-slate-400">admin@vipdigitalhub.com</strong> / <strong class="text-slate-400">password</strong>
                </span>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-brand-400 transition-colors inline-flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Return to VIP Digital Hub Website</span>
            </a>
        </div>
    </div>
</body>
</html>
