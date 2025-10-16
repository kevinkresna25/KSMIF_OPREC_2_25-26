<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Prevent caching for authenticated pages -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>{{ $title ?? config('app.name', 'KSMIF OPREC') }}</title>

    <!-- Favicon & App Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-ksmif.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo-ksmif.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo-ksmif.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#1a0f30">
    <meta name="msapplication-TileColor" content="#1a0f30">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Raleway:wght@400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* CRT Flicker Animation */
        @keyframes flicker {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.97; }
        }
        
        body {
            animation: flicker 0.15s infinite;
        }
        
        /* Pixel Font Glow (Cyan) */
        .pixel-glow {
            text-shadow: 0 0 5px #00f6ff, 0 0 10px #00f6ff;
        }
        
        /* Button Base */
        .btn {
            @apply px-6 py-2 font-raleway font-semibold uppercase tracking-widest rounded-none transition-all duration-300;
        }
        
        /* Button Info (Unsolved Challenge) */
        .btn-info {
            @apply bg-btn-info text-white hover:brightness-110;
        }
        
        /* Button Solved (Green with opacity) */
        .btn-solved {
            @apply text-white hover:brightness-110;
            background-color: rgba(55, 214, 62, 0.4);
        }
        
        /* Button Submit */
        .btn-submit {
            @apply bg-btn-submit text-white hover:brightness-110;
        }
        
        /* Button Danger */
        .btn-danger {
            @apply bg-btn-danger text-white hover:brightness-110;
        }
        
        /* Button Outlined */
        .btn-outlined {
            @apply bg-transparent text-text-default border-2 border-border-default hover:bg-border-default/20 hover:border-text-default;
        }
        
        /* Input Styles */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            @apply bg-gray-200 text-gray-500 border-0 rounded-none px-4 py-3 font-lato transition-all;
        }
        
        /* Input Focus (Green Glow) */
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        textarea:focus {
            @apply bg-transparent text-text-default outline-none;
            box-shadow: 0 0 0 0.1rem #a3d39c;
        }
        
        /* Input Invalid (Red Glow) */
        input.invalid,
        textarea.invalid {
            box-shadow: 0 0 0 0.1rem #d46767 !important;
        }
        
        input::placeholder,
        textarea::placeholder {
            @apply text-gray-400;
        }
        
        /* Card Styles */
        .card {
            @apply bg-bg-card rounded-none p-6 border border-white/5;
        }
        
        /* Challenge Card */
        .challenge-card {
            @apply bg-bg-card rounded-none p-6 border border-white/10 hover:border-btn-info/50 transition-all;
        }
        
        .challenge-card.solved {
            @apply border-btn-solved/50;
        }
    </style>
    
    @stack('styles')
</head>
<body class="h-full bg-bg-main text-gray-200 font-lato antialiased">
    <!-- CRT Scanline Effect -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none z-50" 
         style="background-image: linear-gradient(rgba(0,0,0,0.15) 1px, transparent 1px); background-size: 100% 3px;"></div>
    
    <div class="relative flex flex-col min-h-screen">
        <!-- Navigation -->
        @if(isset($showNav) && $showNav)
            <nav class="bg-bg-navbar border-b border-white/10 shadow-xl relative z-40">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <div class="flex items-center">
                            <a href="{{ route('home') }}" class="flex items-center space-x-3 group transition-all duration-300 hover:scale-105">
                                <!-- Logo Image -->
                                <div class="relative">
                                    <div class="absolute inset-0 bg-text-glow/20 blur-md rounded-full group-hover:bg-text-glow/30 transition-all"></div>
                                    <img 
                                        src="{{ asset('images/logo-ksmif.png') }}" 
                                        alt="Logo KSMIF" 
                                        class="relative w-10 h-10 object-contain drop-shadow-lg"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                    >
                                    <!-- Fallback Icon -->
                                    <div class="hidden w-10 h-10 bg-text-glow/20 rounded-lg items-center justify-center border-2 border-text-glow/50">
                                        <span class="font-pixel text-[8px] text-text-glow">KS</span>
                                    </div>
                                </div>
                                
                                <!-- Text Logo -->
                                <span class="font-pixel text-xs text-text-glow pixel-glow uppercase group-hover:text-white transition-colors">KSMIF</span>
                            </a>
                        </div>
                        
                        <div class="flex items-center space-x-6">
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-gray-200 hover:text-text-glow transition font-raleway font-semibold uppercase text-sm tracking-wider">
                                    Dashboard
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-gray-200 hover:text-btn-danger transition font-raleway font-semibold uppercase text-sm tracking-wider">
                                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="flex items-center gap-2 text-gray-200 hover:text-text-glow transition font-raleway font-semibold uppercase text-sm tracking-wider">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Login
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>
        @endif
        
        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>
        
        <!-- Footer -->
        @if(isset($showFooter) && $showFooter)
            <footer class="bg-bg-navbar border-t border-white/10 py-8 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col items-center space-y-4">
                        <!-- Logo Footer -->
                        <div class="flex items-center space-x-3 group">
                            <div class="relative">
                                <div class="absolute inset-0 bg-text-glow/10 blur-lg rounded-full"></div>
                                <img 
                                    src="{{ asset('images/logo-ksmif.png') }}" 
                                    alt="Logo KSMIF" 
                                    class="relative w-12 h-12 object-contain opacity-80 group-hover:opacity-100 transition-opacity"
                                    onerror="this.style.display='none';"
                                >
                            </div>
                            <div class="text-left">
                                <p class="font-pixel text-xs text-text-glow pixel-glow uppercase leading-tight">KSMIF</p>
                                <p class="font-lato text-[10px] text-gray-400">Kelompok Studi Mahasiswa IF</p>
                            </div>
                        </div>
                        
                        <!-- Footer Info -->
                        <div class="text-center text-gray-200 text-xs space-y-1">
                            <p class="font-pixel text-[10px] text-text-glow pixel-glow uppercase">RetroTerm Challenge</p>
                            <p class="font-lato text-gray-400">Theme designed by <span class="text-text-glow font-semibold">Development Team</span></p>
                            <p class="font-lato opacity-75">© {{ date('Y') }} KSMIF. Open Recruitment Game Besar.</p>
                        </div>

                        <!-- Social Links (Optional - bisa di-uncomment jika diperlukan) -->
                        <!--
                        <div class="flex items-center space-x-4 pt-2">
                            <a href="#" class="text-gray-400 hover:text-text-glow transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.129 22 16.99 22 12c0-5.523-4.477-10-10-10z"/></svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-text-glow transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-text-glow transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            </a>
                        </div>
                        -->
                    </div>
                </div>
            </footer>
        @endif
    </div>
    
    @stack('scripts')
</body>
</html>
