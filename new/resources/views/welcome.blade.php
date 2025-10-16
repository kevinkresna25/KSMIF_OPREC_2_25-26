<x-layouts.retro :showNav="true" :showFooter="true">
    <x-slot name="title">KSMIF - OPREC Game Besar</x-slot>
    
    <!-- Hero/Jumbotron Section -->
    <div class="relative bg-gradient-to-br from-bg-navbar via-bg-main to-bg-card border-b-4 border-text-glow/30 py-24 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 text-text-glow font-pixel text-6xl">{'{'}</div>
            <div class="absolute bottom-10 right-10 text-text-glow font-pixel text-6xl">{'}'}</div>
            <div class="absolute top-1/2 left-1/4 text-text-glow font-pixel text-4xl opacity-20">{'<>'}</div>
            <div class="absolute top-1/3 right-1/4 text-text-glow font-pixel text-4xl opacity-20">{'[]'}</div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Logo KSMIF -->
            <div class="flex justify-center mb-8 animate-pulse">
                <div class="relative group">
                    <!-- Glow effect background -->
                    <div class="absolute inset-0 bg-text-glow/20 blur-2xl rounded-full scale-110 group-hover:scale-125 transition-transform duration-500"></div>
                    
                    <!-- Logo container -->
                    <div class="relative bg-gradient-to-br from-bg-card to-bg-navbar p-4 rounded-2xl border-4 border-text-glow/40 shadow-2xl hover:border-text-glow/60 transition-all duration-300 group-hover:scale-105">
                        <img 
                            src="{{ asset('images/logo-ksmif.png') }}" 
                            alt="Logo KSMIF" 
                            class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 object-contain drop-shadow-2xl"
                            onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 200 200%22%3E%3Crect fill=%22%231a0f30%22 width=%22200%22 height=%22200%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-family=%22monospace%22 font-size=%2260%22 fill=%22%2300f6ff%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22%3EKSMIF%3C/text%3E%3C/svg%3E';"
                        >
                    </div>
                </div>
            </div>

            <!-- Main Title -->
            <div class="mb-4">
                <h1 class="font-pixel text-4xl sm:text-5xl md:text-7xl text-text-glow pixel-glow mb-4 uppercase tracking-wider leading-tight">
                    KSMIF
                </h1>
                <div class="flex items-center justify-center gap-3 mb-6">
                    <div class="h-px w-16 bg-gradient-to-r from-transparent to-text-glow"></div>
                    <h2 class="font-pixel text-lg sm:text-xl md:text-2xl text-btn-submit pixel-glow uppercase">
                        OPREC Game Besar
                    </h2>
                    <div class="h-px w-16 bg-gradient-to-l from-transparent to-text-glow"></div>
                </div>
            </div>

            <!-- Description -->
            <p class="font-raleway text-lg sm:text-xl text-gray-300 mb-4 max-w-4xl mx-auto leading-relaxed">
                Selamat datang di <span class="text-text-glow font-bold pixel-glow">RetroTerm Challenge</span> - 
                Open Recruitment Game Besar KSMIF.
            </p>
            <p class="font-lato text-base sm:text-lg text-gray-400 mb-12 max-w-3xl mx-auto leading-relaxed">
                Uji kemampuan problem-solving dan kriptografimu! Dekripsi fragmen kode, susun potongan, 
                dan tunjukkan bahwa kamu layak bergabung dengan kami.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                @auth('web')
                    {{-- Logged in as Operator --}}
                    <x-button variant="submit" :href="route('dashboard')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        GO TO DASHBOARD
                    </x-button>
                @elseauth('team')
                    {{-- Logged in as Team --}}
                    <x-button variant="submit" :href="route('team.dashboard')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        GO TO DASHBOARD
                    </x-button>
                @else
                    {{-- Not logged in --}}
                    <x-button variant="submit" :href="route('login')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        LOGIN
                    </x-button>
                @endauth
            </div>
        </div>
    </div>
    
    <!-- Features Section -->
    <div class="py-20 bg-gradient-to-b from-bg-main to-bg-card">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="font-pixel text-2xl md:text-3xl text-text-glow pixel-glow mb-4 uppercase tracking-wide">
                    {'>'} MEKANISME CHALLENGE {'<'}
                </h2>
                <p class="font-lato text-gray-400 text-base">Ikuti langkah-langkah berikut untuk menyelesaikan tantangan</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <x-card challenge class="transform hover:scale-105 transition-transform duration-300">
                    <div class="text-center space-y-4">
                        <!-- Icon -->
                        <div class="flex justify-center mb-4">
                            <div class="bg-text-glow/10 rounded-lg p-4 border-2 border-text-glow/30">
                                <svg class="w-8 h-8 text-text-glow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <h3 class="font-pixel text-xs text-text-glow pixel-glow uppercase tracking-wider">
                            01. DEKRIPSI
                        </h3>
                        <p class="font-lato text-gray-300 leading-relaxed text-sm">
                            Setiap tim menerima fragmen kode terenkripsi. Gunakan tool dekripsi AES untuk mengungkap kode rahasia.
                        </p>
                        <a href="{{ route('decrypt.show') }}" class="inline-flex items-center gap-2 text-text-glow hover:text-btn-submit transition-colors font-raleway text-sm font-semibold group">
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                            Mulai Dekripsi
                        </a>
                    </div>
                </x-card>
                
                <!-- Card 2 -->
                <x-card challenge class="transform hover:scale-105 transition-transform duration-300">
                    <div class="text-center space-y-4">
                        <!-- Icon -->
                        <div class="flex justify-center mb-4">
                            <div class="bg-btn-success/10 rounded-lg p-4 border-2 border-btn-success/30">
                                <svg class="w-8 h-8 text-btn-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <h3 class="font-pixel text-xs text-btn-success pixel-glow uppercase tracking-wider">
                            02. VERIFIKASI
                        </h3>
                        <p class="font-lato text-gray-300 leading-relaxed text-sm">
                            Panitia akan memverifikasi dan memilih satu submission per tim yang paling tepat untuk tahap final.
                        </p>
                    </div>
                </x-card>
                
                <!-- Card 3 -->
                <x-card challenge class="transform hover:scale-105 transition-transform duration-300">
                    <div class="text-center space-y-4">
                        <!-- Icon -->
                        <div class="flex justify-center mb-4">
                            <div class="bg-btn-submit/10 rounded-lg p-4 border-2 border-btn-submit/30">
                                <svg class="w-8 h-8 text-btn-submit" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <h3 class="font-pixel text-xs text-btn-submit pixel-glow uppercase tracking-wider">
                            03. SUSUN
                        </h3>
                        <p class="font-lato text-gray-300 leading-relaxed text-sm">
                            Susun semua fragmen dalam urutan yang benar untuk mengungkap pesan tersembunyi dan selesaikan tantangan!
                        </p>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
    
    <!-- Stats Section -->
    @if(isset($stats))
    <div class="py-16 bg-bg-navbar border-y border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <x-card class="text-center border-btn-info/50">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-btn-info mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="font-pixel text-3xl text-btn-info mb-2">{{ $stats['teams'] ?? 0 }}</p>
                        <p class="font-raleway text-gray-300 uppercase tracking-wider text-sm">Teams</p>
                    </div>
                </x-card>
                
                <x-card class="text-center border-btn-success/50">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-btn-success mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="font-pixel text-3xl text-btn-success mb-2">{{ $stats['submissions'] ?? 0 }}</p>
                        <p class="font-raleway text-gray-300 uppercase tracking-wider text-sm">Submissions</p>
                    </div>
                </x-card>
                
                <x-card class="text-center border-btn-submit/50">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-btn-submit mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                        </svg>
                        <p class="font-pixel text-3xl text-btn-submit mb-2">{{ $stats['snippets'] ?? 0 }}</p>
                        <p class="font-raleway text-gray-300 uppercase tracking-wider text-sm">Fragments</p>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
    @endif
    
    <!-- CTA Section -->
    <div class="relative py-24 bg-gradient-to-t from-bg-navbar to-bg-main overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-text-glow via-transparent to-btn-submit animate-pulse"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Call to Action Title -->
            <div class="mb-8">
                <h2 class="font-pixel text-2xl md:text-3xl text-text-glow pixel-glow mb-4 uppercase leading-relaxed tracking-wide">
                    {'>'} SIAP MENERIMA TANTANGAN? {'<'}
                </h2>
                <div class="h-1 w-32 mx-auto bg-gradient-to-r from-transparent via-text-glow to-transparent mb-6"></div>
            </div>

            <p class="font-raleway text-lg sm:text-xl text-gray-300 mb-4 leading-relaxed">
                Bergabunglah dalam challenge sekarang dan buktikan kemampuanmu!
            </p>
            <p class="font-lato text-base text-gray-400 mb-10 leading-relaxed">
                Waktu terus berjalan... Apakah kamu cukup cepat untuk memecahkan kode ini?
            </p>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                @guest
                    <x-button variant="submit" :href="route('login')" class="text-lg px-10 py-4 group">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="font-pixel text-sm">&gt; LOGIN NOW_</span>
                    </x-button>
                @else
                    <x-button variant="submit" :href="route('submission.create')" class="text-lg px-10 py-4 group">
                        <svg class="w-6 h-6 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="font-pixel text-sm">&gt; SUBMIT CODE_</span>
                    </x-button>
                @endguest
            </div>

            <!-- Extra Info -->
            <div class="mt-12 pt-8 border-t border-white/10">
                <p class="font-lato text-sm text-gray-500 italic">
                    "Hanya mereka yang berani menghadapi tantangan yang akan menemukan jalannya." - KSMIF
                </p>
            </div>
        </div>
    </div>
</x-layouts.retro>
