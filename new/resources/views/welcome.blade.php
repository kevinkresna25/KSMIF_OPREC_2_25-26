<x-layouts.retro :showNav="true" :showFooter="true">
    <x-slot name="title">Welcome - Puzzle Game</x-slot>
    
    <!-- Hero/Jumbotron Section -->
    <div class="bg-bg-navbar border-b-2 border-white/20 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-pixel text-3xl sm:text-4xl md:text-5xl text-text-glow pixel-glow mb-8 uppercase leading-relaxed">
                PUZZLE GAME
            </h1>
            <p class="font-raleway text-xl text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed">
                Welcome to the <span class="text-text-glow font-bold pixel-glow">RetroTerm</span> Puzzle Challenge. 
                Decode the fragments, arrange the pieces, and unlock the final message.
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
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-pixel text-2xl text-text-glow pixel-glow mb-12 text-center uppercase">
                HOW IT WORKS
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <x-card challenge>
                    <div class="text-center">
                        <h3 class="font-pixel text-xs text-text-glow pixel-glow mb-4 uppercase">STEP 1: DECRYPT</h3>
                        <p class="font-lato text-gray-300 leading-relaxed text-sm mb-4">
                            Each team receives encrypted code fragments. Analyze and prepare your submission using AES decryption.
                        </p>
                        <a href="{{ route('decrypt.show') }}" class="inline-flex items-center gap-2 text-text-glow hover:text-text-glow/80 font-raleway text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Decrypt Tool →
                        </a>
                    </div>
                </x-card>
                
                <!-- Card 2 -->
                <x-card challenge>
                    <div class="text-center">
                        <h3 class="font-pixel text-xs text-text-glow pixel-glow mb-4 uppercase">STEP 2: VERIFY</h3>
                        <p class="font-lato text-gray-300 leading-relaxed text-sm">
                            Operators verify and select one submission per team for the final puzzle arrangement.
                        </p>
                    </div>
                </x-card>
                
                <!-- Card 3 -->
                <x-card challenge>
                    <div class="text-center">
                        <h3 class="font-pixel text-xs text-text-glow pixel-glow mb-4 uppercase">STEP 3: SOLVE</h3>
                        <p class="font-lato text-gray-300 leading-relaxed text-sm">
                            Arrange all fragments in correct order to reveal the hidden message and complete the challenge.
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
    <div class="py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-pixel text-2xl text-text-glow pixel-glow mb-6 uppercase leading-relaxed">
                READY TO DECODE?
            </h2>
            <p class="font-raleway text-lg text-gray-300 mb-8 leading-relaxed">
                Join the challenge now and prove your skills. The clock is ticking...
            </p>
            
            @guest
                <x-button variant="submit" :href="route('login')" class="text-lg px-12 py-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    &gt; LOGIN NOW_
                </x-button>
            @else
                <x-button variant="submit" :href="route('submission.create')" class="text-lg px-12 py-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    &gt; SUBMIT CODE_
                </x-button>
            @endguest
        </div>
    </div>
</x-layouts.retro>
