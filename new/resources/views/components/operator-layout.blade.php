@props(['title' => 'Dashboard Operator'])

<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }} — KSMIF OPREC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon & App Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-ksmif.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo-ksmif.png') }}">
    <meta name="theme-color" content="#1a0f30">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Raleway:wght@400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    
    <style>
        /* CRT Screen Effect with Flicker */
        @keyframes flicker {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.95; }
        }
        
        .scanline {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: repeating-linear-gradient(
                0deg,
                rgba(0, 0, 0, 0.1) 0px,
                rgba(0, 0, 0, 0.1) 1px,
                transparent 1px,
                transparent 2px
            );
            pointer-events: none;
            z-index: 9999;
            animation: flicker 0.15s infinite;
        }
        
        .pixel-glow {
            text-shadow: 
                0 0 5px #5b7290,
                0 0 10px #5b7290,
                0 0 15px #5b7290;
        }
        
        /* Sidebar transitions */
        #sidebar {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        #sidebar.minimized {
            width: 5rem;
        }
        
        /* Mobile sidebar hidden state */
        #sidebar.mobile-hidden {
            left: -16rem;
        }
        
        #sidebar .menu-text,
        #sidebar .logo-text,
        #sidebar .section-title {
            transition: opacity 0.2s ease, width 0.2s ease;
            white-space: nowrap;
        }
        
        #sidebar.minimized .menu-text,
        #sidebar.minimized .logo-text,
        #sidebar.minimized .section-title {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }
        
        /* Menu hover effect */
        .menu-item {
            position: relative;
        }
        
        .menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: #5b7290;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .menu-item:hover::before,
        .menu-item.active::before {
            transform: scaleY(1);
        }
        
        #main-content {
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        #main-content.sidebar-minimized {
            margin-left: 5rem;
        }
        
        #logoToggle {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        #logoToggle:hover {
            filter: brightness(1.1);
        }
        
        #logoIcon {
            transition: transform 0.3s ease;
        }
    </style>
</head>
<body class="h-full bg-bg-main text-text-default font-lato antialiased">
    <!-- CRT Scanline Effect -->
    <div class="scanline"></div>
    
    {{-- Sidebar --}}
    <div class="fixed inset-y-0 left-0 w-64 bg-bg-card border-r border-white/10 z-30 flex flex-col"
         id="sidebar">
        {{-- Logo Header (Toggle) --}}
        <div id="logoToggle" 
             class="flex items-center justify-between h-16 px-4 bg-bg-navbar border-b border-white/10 flex-shrink-0 cursor-pointer group"
             title="Click to toggle sidebar">
            <div class="flex items-center gap-3 overflow-hidden">
                <!-- Logo KSMIF with rotation animation -->
                <div id="logoIcon" class="relative w-10 h-10 flex items-center justify-center flex-shrink-0 transition-transform duration-300">
                    <div class="absolute inset-0 bg-text-accent-blue/20 rounded-lg blur-sm group-hover:bg-text-accent-blue/30 transition-all"></div>
                    <img 
                        src="{{ asset('images/logo-ksmif.png') }}" 
                        alt="Logo KSMIF" 
                        class="relative w-8 h-8 object-contain drop-shadow-lg"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                    >
                    <!-- Fallback -->
                    <div class="hidden w-10 h-10 bg-text-accent-blue rounded-lg items-center justify-center border-2 border-white/20">
                        <span class="font-pixel text-[10px] text-white">OP</span>
                    </div>
                </div>
                
                <div class="logo-text overflow-hidden">
                    <p class="font-pixel text-xs text-text-accent-blue pixel-glow uppercase leading-tight">KSMIF</p>
                    <p class="text-[10px] text-gray-400 font-lato">Operator Panel</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto px-3 py-6">
            <div class="space-y-1">
                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}" 
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-none transition-all duration-200 {{ request()->routeIs('dashboard') ? 'active bg-text-accent-blue text-white' : 'text-text-default hover:bg-text-accent-blue/20 hover:text-text-accent-blue' }}"
                   title="Dashboard">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="menu-text font-raleway font-semibold">Dashboard</span>
                </a>

                {{-- Arrangement --}}
                <a href="{{ route('operator.arrange.show') }}" 
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-none transition-all duration-200 {{ request()->routeIs('operator.arrange.*') ? 'active bg-text-accent-blue text-white' : 'text-text-default hover:bg-text-accent-blue/20 hover:text-text-accent-blue' }}"
                   title="Susun Urutan">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <span class="menu-text font-raleway font-semibold">Arrange</span>
                </a>

                {{-- Divider --}}
                <div class="pt-6 pb-2">
                    <p class="section-title px-4 text-xs font-pixel text-text-accent-blue uppercase">MANAGE</p>
                </div>

                {{-- Teams --}}
                <a href="{{ route('operator.manage.teams.index') }}" 
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-none transition-all duration-200 {{ request()->routeIs('operator.manage.teams.*') ? 'active bg-text-accent-blue text-white' : 'text-text-default hover:bg-text-accent-blue/20 hover:text-text-accent-blue' }}"
                   title="Kelola Tim">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="menu-text font-raleway font-semibold">Teams</span>
                </a>

                {{-- Snippets --}}
                <a href="{{ route('operator.manage.snippets.index') }}" 
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-none transition-all duration-200 {{ request()->routeIs('operator.manage.snippets.*') ? 'active bg-text-accent-blue text-white' : 'text-text-default hover:bg-text-accent-blue/20 hover:text-text-accent-blue' }}"
                   title="Kelola Snippet">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                    <span class="menu-text font-raleway font-semibold">Snippets</span>
                </a>

                {{-- Submissions --}}
                <a href="{{ route('operator.manage.submissions.index') }}" 
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-none transition-all duration-200 {{ request()->routeIs('operator.manage.submissions.*') ? 'active bg-text-accent-blue text-white' : 'text-text-default hover:bg-text-accent-blue/20 hover:text-text-accent-blue' }}"
                   title="Kelola Inputan">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="menu-text font-raleway font-semibold">Inputs</span>
                </a>

                {{-- Divider --}}
                <div class="pt-6 pb-2">
                    <p class="section-title px-4 text-xs font-pixel text-text-accent-blue uppercase">TOOLS</p>
                </div>

                {{-- Encrypt Tool --}}
                <a href="{{ route('encrypt.show') }}" 
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-none transition-all duration-200 {{ request()->routeIs('encrypt.*') ? 'active bg-text-accent-blue text-white' : 'text-text-default hover:bg-text-accent-blue/20 hover:text-text-accent-blue' }}"
                   title="Encrypt Tool">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <span class="menu-text font-raleway font-semibold">Encrypt</span>
                </a>

                {{-- Divider --}}
                <div class="pt-6 pb-2">
                    <p class="section-title px-4 text-xs font-pixel text-text-accent-blue uppercase">ACCOUNT</p>
                </div>

                {{-- Profile --}}
                <a href="{{ route('profile.edit') }}" 
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-none transition-all duration-200 text-text-default hover:bg-text-accent-blue/20 hover:text-text-accent-blue"
                   title="Profile">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="menu-text font-raleway font-semibold">Profile</span>
                </a>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full menu-item flex items-center gap-3 px-4 py-3 rounded-none transition-all duration-200 text-btn-danger hover:bg-btn-danger/20"
                            title="Logout">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="menu-text font-raleway font-semibold">Logout</span>
                    </button>
                </form>
            </div>
        </nav>

        {{-- User Info --}}
        <div class="flex-shrink-0 p-4 bg-bg-navbar border-t border-white/10" id="userInfo">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-none bg-text-accent-blue flex items-center justify-center flex-shrink-0 border border-white/20">
                    <span class="text-lg font-pixel text-xs text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <div class="menu-text flex-1 min-w-0">
                    <p class="text-sm font-semibold truncate text-text-default font-raleway">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-text-accent-blue truncate font-lato">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Toggle --}}
    <button id="sidebarToggleMobile" 
            class="lg:hidden fixed top-4 left-4 z-40 p-3 bg-text-accent-blue text-white rounded-none shadow-lg border border-white/20">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    {{-- Main Content --}}
    <div class="lg:ml-64 transition-all duration-300" id="main-content">
        {{-- Top Bar --}}
        <div class="sticky top-0 z-20 bg-bg-navbar border-b border-white/10 px-6 h-16 shadow-lg flex items-center">
            <h1 class="font-pixel text-sm text-text-accent-blue pixel-glow uppercase">{{ $title }}</h1>
        </div>

        {{-- Content --}}
        <main class="p-6">
            {{ $slot }}
        </main>
    </div>

    {{-- Overlay --}}
    <div id="sidebarOverlay" class="lg:hidden fixed inset-0 bg-black/70 z-20 hidden"></div>

    @stack('scripts')
    
    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const logoToggle = document.getElementById('logoToggle');
        const logoIcon = document.getElementById('logoIcon');
        const toggleMobile = document.getElementById('sidebarToggleMobile');
        const overlay = document.getElementById('sidebarOverlay');

        const sidebarState = localStorage.getItem('sidebarMinimized');
        
        if (window.innerWidth >= 1024 && sidebarState === 'true') {
            minimizeSidebar();
        }

        logoToggle?.addEventListener('click', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.contains('minimized') ? expandSidebar() : minimizeSidebar();
            }
        });

        function minimizeSidebar() {
            sidebar.classList.add('minimized');
            mainContent.classList.add('sidebar-minimized');
            logoIcon.style.transform = 'rotate(180deg)';
            localStorage.setItem('sidebarMinimized', 'true');
        }

        function expandSidebar() {
            sidebar.classList.remove('minimized');
            mainContent.classList.remove('sidebar-minimized');
            logoIcon.style.transform = 'rotate(0deg)';
            localStorage.setItem('sidebarMinimized', 'false');
        }

        toggleMobile?.addEventListener('click', () => {
            sidebar.classList.toggle('mobile-hidden');
            overlay.classList.toggle('hidden');
        });

        overlay?.addEventListener('click', () => {
            sidebar.classList.add('mobile-hidden');
            overlay.classList.add('hidden');
        });

        if (window.innerWidth < 1024) {
            sidebar.classList.add('mobile-hidden');
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('mobile-hidden');
                overlay.classList.add('hidden');
                if (localStorage.getItem('sidebarMinimized') === 'true') {
                    minimizeSidebar();
                }
            } else {
                sidebar.classList.add('mobile-hidden');
                sidebar.classList.remove('minimized');
                mainContent.classList.remove('sidebar-minimized');
                logoIcon.style.transform = 'rotate(0deg)';
            }
        });
    </script>
</body>
</html>
