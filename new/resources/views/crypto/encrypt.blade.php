<x-operator-layout title="Encrypt Tool">
    <div class="max-w-4xl mx-auto">
        {{-- Header --}}
        <div class="mb-6">
            <div class="mb-4">
                <h1 class="text-2xl font-pixel text-text-glow pixel-glow uppercase mb-2">
                    ENCRYPT TOOL
                </h1>
                <p class="text-gray-400 font-raleway text-sm">
                    Buat encrypted fragments untuk tim
                </p>
            </div>
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

        {{-- Encrypt Form --}}
        <x-card class="mb-6">
            <h2 class="text-xl font-pixel text-text-glow pixel-glow uppercase mb-6">
                INPUT
            </h2>
            
            <form method="POST" action="{{ route('encrypt.process') }}" class="space-y-6">
                @csrf

                {{-- Plain Text --}}
                <div>
                    <label class="block text-sm font-raleway font-medium text-text-default mb-2">
                        Plain Text / HTML Code <span class="text-btn-danger">*</span>
                    </label>
                    <textarea 
                        name="text" 
                        rows="8"
                        class="block w-full bg-transparent border-b-2 border-border-default text-text-default placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-input-focus rounded-none font-mono text-sm"
                        placeholder="Masukkan text/HTML yang akan di-encrypt..."
                        required>{{ old('text') }}</textarea>
                    @error('text')
                        <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Encryption Key --}}
                <div>
                    <label class="block text-sm font-raleway font-medium text-text-default mb-2">
                        Encryption Key <span class="text-btn-danger">*</span>
                    </label>
                    <div class="flex gap-2">
                        <x-input 
                            type="text" 
                            name="key" 
                            id="key-input"
                            :value="old('key')"
                            placeholder="Masukkan key untuk encrypt"
                            class="flex-1"
                            required
                        />
                        <button 
                            type="button"
                            onclick="generateRandomKey()"
                            class="px-4 py-2 bg-btn-info text-white rounded-none hover:brightness-110 transition font-raleway text-sm uppercase tracking-wider whitespace-nowrap"
                        >
                            Generate Key
                        </button>
                    </div>
                    @error('key')
                        <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-400 font-lato">
                        Key akan di-hash menggunakan SHA-256 untuk AES-256-CBC. Simpan key ini untuk diberikan ke tim!
                    </p>
                </div>

                {{-- Submit Button --}}
                <div class="flex items-center gap-3">
                    <x-button type="submit" variant="primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        ENCRYPT
                    </x-button>
                    <x-button type="reset" variant="outlined">
                        Reset
                    </x-button>
                </div>
            </form>
        </x-card>

        {{-- Result --}}
        @if (session('encrypted'))
            <x-card>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-pixel text-text-glow pixel-glow uppercase">
                        ENCRYPTED RESULT
                    </h2>
                    <button 
                        onclick="copyToClipboard('encrypted-result')"
                        class="px-3 py-2 bg-btn-success text-white rounded-none hover:brightness-110 transition font-raleway text-sm uppercase tracking-wider"
                    >
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Copy
                    </button>
                </div>
                
                <div class="bg-bg-main p-4 rounded-none border-2 border-border-default">
                    <pre id="encrypted-result" class="text-text-default font-mono text-sm whitespace-pre-wrap break-all">{{ session('encrypted') }}</pre>
                </div>

                <div class="mt-4 p-4 bg-btn-info/20 border-2 border-btn-info rounded-none">
                    <p class="text-sm text-text-default font-raleway">
                        <strong class="text-text-glow">Penting:</strong> Simpan key yang digunakan dan berikan ke tim bersama encrypted text ini!
                    </p>
                </div>
            </x-card>
        @endif

        {{-- Info Section --}}
        <x-card class="mt-6 bg-bg-card/50">
            <h3 class="text-lg font-pixel text-text-accent-blue uppercase mb-4">INFORMASI</h3>
            <ul class="space-y-2 text-sm text-gray-300 font-lato">
                <li class="flex items-start gap-2">
                    <span class="text-text-glow">▸</span>
                    <span>Tool ini menggunakan algoritma <strong>AES-256-CBC</strong></span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-text-glow">▸</span>
                    <span>Hasil encryption dalam format <strong>Base64</strong></span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-text-glow">▸</span>
                    <span>IV (Initialization Vector) otomatis di-generate secara random</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-text-glow">▸</span>
                    <span>Pastikan menyimpan <strong>key</strong> untuk diberikan ke tim!</span>
                </li>
            </ul>
        </x-card>
    </div>

    @push('scripts')
    <script>
        function copyToClipboard(elementId) {
            const element = document.getElementById(elementId);
            const text = element.textContent;
            
            navigator.clipboard.writeText(text).then(() => {
                alert('Copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy:', err);
            });
        }

        function generateRandomKey() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
            let key = '';
            for (let i = 0; i < 32; i++) {
                key += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('key-input').value = key;
        }
    </script>
    @endpush
</x-operator-layout>

