<x-layouts.retro :show-nav="true" :show-footer="true">
    <x-slot name="title">Decrypt Tool - Puzzle Game</x-slot>
    
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">
            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="inline-block text-6xl mb-4">🔓</div>
                <h1 class="text-3xl font-pixel text-text-glow pixel-glow uppercase mb-4">
                    DECRYPT TOOL
                </h1>
                <p class="text-gray-300 font-raleway">
                    Decrypt encrypted fragments menggunakan AES-256-CBC
                </p>
            </div>

            {{-- Alerts --}}
            @if (session('success'))
                <x-alert type="success" class="mb-6">
                    {{ session('success') }}
                </x-alert>
            @endif
            
            @if (session('error'))
                <x-alert type="error" class="mb-6">
                    {{ session('error') }}
                </x-alert>
            @endif

            {{-- Decrypt Form --}}
            <x-card class="mb-6">
                <h2 class="text-xl font-pixel text-text-glow pixel-glow uppercase mb-6">
                    INPUT
                </h2>
                
                <form method="POST" action="{{ route('decrypt.process') }}" class="space-y-6">
                    @csrf

                    {{-- Encrypted Text --}}
                    <div>
                        <label class="block text-sm font-raleway font-medium text-text-default mb-2">
                            Encrypted Text (Base64) <span class="text-btn-danger">*</span>
                        </label>
                        <textarea 
                            name="encrypted" 
                            rows="6"
                            class="block w-full bg-transparent border-b-2 border-border-default text-text-default placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-input-focus rounded-none font-mono text-sm"
                            placeholder="Paste encrypted text di sini..."
                            required>{{ old('encrypted') }}</textarea>
                        @error('encrypted')
                            <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Decryption Key --}}
                    <div>
                        <label class="block text-sm font-raleway font-medium text-text-default mb-2">
                            Decryption Key <span class="text-btn-danger">*</span>
                        </label>
                        <x-input 
                            type="text" 
                            name="key" 
                            :value="old('key')"
                            placeholder="Masukkan key untuk decrypt"
                            required
                        />
                        @error('key')
                            <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-400 font-lato">
                            Key akan di-hash menggunakan SHA-256 untuk AES-256-CBC
                        </p>
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex items-center gap-3">
                        <x-button type="submit" variant="primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            DECRYPT
                        </x-button>
                        <x-button type="reset" variant="outlined">
                            Reset
                        </x-button>
                    </div>
                </form>
            </x-card>

            {{-- Result --}}
            @if (session('decrypted'))
                <x-card>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-pixel text-text-glow pixel-glow uppercase">
                            DECRYPTED RESULT
                        </h2>
                        <button 
                            onclick="copyToClipboard('decrypted-result')"
                            class="px-3 py-2 bg-btn-info text-white rounded-none hover:brightness-110 transition font-raleway text-sm uppercase tracking-wider"
                        >
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            Copy
                        </button>
                    </div>
                    
                    <div class="bg-bg-main p-4 rounded-none border-2 border-border-default">
                        <pre id="decrypted-result" class="text-text-default font-mono text-sm whitespace-pre-wrap break-words">{{ session('decrypted') }}</pre>
                    </div>

                    <div class="mt-4 flex gap-3">
                        <a href="{{ route('submission.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-btn-success text-white rounded-none hover:brightness-110 transition font-raleway text-sm uppercase tracking-wider">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Submit Hasil Ini
                        </a>
                    </div>
                </x-card>
            @endif

            {{-- Info Section --}}
            <x-card class="mt-6 bg-bg-card/50">
                <h3 class="text-lg font-pixel text-text-accent-blue uppercase mb-4">ℹ️ INFORMASI</h3>
                <ul class="space-y-2 text-sm text-gray-300 font-lato">
                    <li class="flex items-start gap-2">
                        <span class="text-text-glow">▸</span>
                        <span>Tool ini menggunakan algoritma <strong>AES-256-CBC</strong></span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-text-glow">▸</span>
                        <span>Encrypted text harus dalam format <strong>Base64</strong></span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-text-glow">▸</span>
                        <span>Key akan di-hash menggunakan <strong>SHA-256</strong> sebelum digunakan</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-text-glow">▸</span>
                        <span>Setelah decrypt berhasil, copy hasil dan submit di halaman input</span>
                    </li>
                </ul>
            </x-card>
        </div>
    </div>

    @push('scripts')
    <script>
        function copyToClipboard(elementId) {
            const element = document.getElementById(elementId);
            const text = element.textContent;
            
            navigator.clipboard.writeText(text).then(() => {
                // Show toast or alert
                alert('Copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy:', err);
            });
        }
    </script>
    @endpush
</x-layouts.retro>

