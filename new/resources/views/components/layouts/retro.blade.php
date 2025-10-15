<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Puzzle Game') }}</title>

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
                            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                                <span class="text-2xl group-hover:scale-110 transition-transform">🧩</span>
                                <span class="font-pixel text-xs text-text-glow pixel-glow uppercase">PUZZLE</span>
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
            <footer class="bg-bg-navbar border-t border-white/10 py-4 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center text-gray-200 text-xs space-y-1">
                        <p class="font-pixel text-[10px] text-text-glow pixel-glow uppercase">RetroTerm</p>
                        <p class="font-lato">Theme designed by <span class="text-text-glow font-semibold">Development Team</span></p>
                        <p class="font-lato opacity-75">© {{ date('Y') }} Puzzle Game. Powered by Laravel.</p>
                    </div>
                </div>
            </footer>
        @endif
    </div>
    
    @stack('scripts')
</body>
</html>
