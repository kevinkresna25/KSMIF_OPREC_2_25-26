<x-layouts.retro :showNav="true" :showFooter="true">
    <x-slot name="title">KSMIF - OPREC Game Besar</x-slot>
    
    <!-- Hero Section - Clean & Minimal -->
    <div class="relative bg-bg-main py-32 overflow-hidden">
        <!-- Subtle Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-20 left-[10%] text-text-glow font-pixel text-4xl">{'</'}</div>
            <div class="absolute bottom-20 right-[10%] text-text-glow font-pixel text-4xl">{'/>'}</div>
        </div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Logo - Simple & Clean -->
            <div class="flex justify-center mb-8">
                <div class="relative group">
                    <div class="absolute inset-0 bg-text-glow/10 blur-xl rounded-full"></div>
                    <img 
                        src="{{ asset('images/logo-ksmif.png') }}" 
                        alt="Logo KSMIF" 
                        class="relative w-24 h-24 sm:w-28 sm:h-28 object-contain transition-transform duration-300 group-hover:scale-105"
                        onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 200 200%22%3E%3Crect fill=%22%231a0f30%22 width=%22200%22 height=%22200%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-family=%22monospace%22 font-size=%2260%22 fill=%22%2300f6ff%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22%3EKSMIF%3C/text%3E%3C/svg%3E';"
                    >
                </div>
            </div>

            <!-- Title - Minimalist -->
            <h1 class="font-pixel text-3xl sm:text-4xl md:text-5xl text-text-glow pixel-glow mb-3 uppercase tracking-wide">
                KSMIF
            </h1>
            <p class="font-raleway text-xl sm:text-2xl text-gray-300 mb-8">
                OPREC Game Besar
            </p>

            <!-- Description - Concise -->
            <p class="font-lato text-base sm:text-lg text-gray-400 mb-12 max-w-2xl mx-auto leading-relaxed">
                RetroTerm Challenge - Uji kemampuan problem-solving dan kriptografimu
            </p>
            
            <!-- CTA Button -->
            @auth('web')
                <x-button variant="submit" :href="route('dashboard')" class="inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    Dashboard
                </x-button>
            @elseauth('team')
                <x-button variant="submit" :href="route('team.dashboard')" class="inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </x-button>
            @else
                <x-button variant="submit" :href="route('login')" class="inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Login
                </x-button>
            @endauth
        </div>
    </div>
    
    <!-- Features Section - Grid Layout -->
    <div class="py-20 bg-bg-card/30">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Title -->
            <div class="text-center mb-12">
                <h2 class="font-pixel text-xl md:text-2xl text-text-glow pixel-glow uppercase mb-2">
                    Mekanisme Challenge
                </h2>
                <div class="h-px w-24 mx-auto bg-text-glow/50 mt-4"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                <!-- Step 1 -->
                <div class="bg-bg-card/50 border border-text-glow/20 p-8 transition-all duration-300 hover:border-text-glow/40 hover:bg-bg-card/70 group">
                    <div class="text-center space-y-4">
                        <div class="inline-flex items-center justify-center w-16 h-16 border-2 border-text-glow/30 bg-text-glow/5 mb-2 group-hover:border-text-glow/50 transition-colors">
                            <svg class="w-8 h-8 text-text-glow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="font-pixel text-xs text-text-glow uppercase tracking-wide">
                            01. Dekripsi
                        </h3>
                        <p class="font-lato text-gray-300 text-sm leading-relaxed">
                            Dekripsi fragmen kode terenkripsi menggunakan tool AES
                        </p>
                        <a href="{{ route('decrypt.show') }}" class="inline-flex items-center gap-2 text-text-glow hover:text-white transition-colors font-raleway text-xs font-semibold uppercase tracking-wider group/link">
                            <span>Mulai</span>
                            <svg class="w-3 h-3 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Step 2 -->
                <div class="bg-bg-card/50 border border-btn-success/20 p-8 transition-all duration-300 hover:border-btn-success/40 hover:bg-bg-card/70 group">
                    <div class="text-center space-y-4">
                        <div class="inline-flex items-center justify-center w-16 h-16 border-2 border-btn-success/30 bg-btn-success/5 mb-2 group-hover:border-btn-success/50 transition-colors">
                            <svg class="w-8 h-8 text-btn-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-pixel text-xs text-btn-success uppercase tracking-wide">
                            02. Verifikasi
                        </h3>
                        <p class="font-lato text-gray-300 text-sm leading-relaxed">
                            Panitia memverifikasi submission terbaik untuk tahap final
                        </p>
                    </div>
                </div>
                
                <!-- Step 3 -->
                <div class="bg-bg-card/50 border border-btn-submit/20 p-8 transition-all duration-300 hover:border-btn-submit/40 hover:bg-bg-card/70 group">
                    <div class="text-center space-y-4">
                        <div class="inline-flex items-center justify-center w-16 h-16 border-2 border-btn-submit/30 bg-btn-submit/5 mb-2 group-hover:border-btn-submit/50 transition-colors">
                            <svg class="w-8 h-8 text-btn-submit" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                            </svg>
                        </div>
                        <h3 class="font-pixel text-xs text-btn-submit uppercase tracking-wide">
                            03. Susun
                        </h3>
                        <p class="font-lato text-gray-300 text-sm leading-relaxed">
                            Susun fragmen untuk mengungkap pesan tersembunyi
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Stats Section - Simplified -->
    @if(isset($stats))
    <div class="py-16 bg-bg-main border-y border-white/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                <!-- Teams -->
                <div class="text-center">
                    <svg class="w-10 h-10 text-btn-info mx-auto mb-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <p class="font-pixel text-2xl text-btn-info mb-1">{{ $stats['teams'] ?? 0 }}</p>
                    <p class="font-raleway text-gray-400 text-xs uppercase tracking-widest">Teams</p>
                </div>
                
                <!-- Submissions -->
                <div class="text-center">
                    <svg class="w-10 h-10 text-btn-success mx-auto mb-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="font-pixel text-2xl text-btn-success mb-1">{{ $stats['submissions'] ?? 0 }}</p>
                    <p class="font-raleway text-gray-400 text-xs uppercase tracking-widest">Submissions</p>
                </div>
                
                <!-- Fragments -->
                <div class="text-center">
                    <svg class="w-10 h-10 text-btn-submit mx-auto mb-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                    </svg>
                    <p class="font-pixel text-2xl text-btn-submit mb-1">{{ $stats['snippets'] ?? 0 }}</p>
                    <p class="font-raleway text-gray-400 text-xs uppercase tracking-widest">Fragments</p>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <!-- CTA Section - Minimalist -->
    <div class="py-20 bg-bg-card/30">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-pixel text-xl md:text-2xl text-text-glow pixel-glow mb-6 uppercase">
                Siap Menerima Tantangan?
            </h2>
            
            <p class="font-lato text-base text-gray-400 mb-8 leading-relaxed">
                Bergabunglah sekarang dan buktikan kemampuanmu
            </p>
            
            @guest
                <x-button variant="submit" :href="route('login')" class="inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-pixel text-sm">Login</span>
                </x-button>
            @else
                <x-button variant="submit" :href="route('submission.create')" class="inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="font-pixel text-sm">Submit Code</span>
                </x-button>
            @endguest
        </div>
    </div>
</x-layouts.retro>
