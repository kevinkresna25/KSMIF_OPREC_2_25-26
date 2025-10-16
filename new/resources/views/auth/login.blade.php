<x-layouts.retro :showNav="false" :showFooter="false">
    <x-slot name="title">Login - Puzzle Game</x-slot>
    
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo/Header -->
            <div class="text-center">
                <h2 class="font-pixel text-2xl text-text-glow pixel-glow mb-4 uppercase">
                    LOGIN
                </h2>
            </div>
            
            <!-- Login Form Card -->
            <x-card>
                <!-- Session Status -->
                @if(session('status'))
                    <x-alert type="success" class="mb-6">
                        {{ session('status') }}
                    </x-alert>
                @endif
                
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Login (Email or Username) -->
                    <x-input 
                        label="Email atau Username"
                        name="login"
                        type="text"
                        :required="true"
                        :value="old('login')"
                        autocomplete="username"
                        placeholder="email@example.com atau username"
                        :error="$errors->first('login')"
                    />
                    
                    <!-- Password -->
                    <x-input 
                        label="Password"
                        name="password"
                        type="password"
                        :required="true"
                        autocomplete="current-password"
                        placeholder="••••••••"
                        :error="$errors->first('password')"
                    />
                    
                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            name="remember"
                            class="rounded-none border-border-default text-btn-submit focus:ring-btn-submit focus:ring-offset-0 bg-transparent"
                        >
                        <label for="remember_me" class="ml-2 text-sm text-gray-300 font-raleway">
                            Remember me
                        </label>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex flex-col space-y-4 pt-2">
                        <x-button type="submit" variant="submit" class="w-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            ACCESS SYSTEM_
                        </x-button>
                    </div>
                </form>
            </x-card>
            
            <!-- Back to Home -->
            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="text-sm text-btn-info hover:text-text-glow transition font-raleway inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</x-layouts.retro>
