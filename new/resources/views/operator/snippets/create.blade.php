<x-operator-layout title="Tambah Snippet Baru">
        <x-card>
            <div class="mb-6">
                <h2 class="text-2xl font-pixel text-text-glow pixel-glow uppercase">Tambah Snippet</h2>
                <p class="text-text-default mt-2 font-lato">Tambahkan potongan kode/HTML baru untuk puzzle.</p>
            </div>

            @if ($errors->any())
                <x-alert type="error" class="mb-6">
                    <ul class="list-disc ms-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-alert>
            @endif

            <form method="POST" action="{{ route('operator.manage.snippets.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="correct_order" class="block text-sm font-raleway font-medium text-text-default mb-2">
                        Urutan yang Benar <span class="text-btn-danger">*</span>
                    </label>
                    <x-input 
                        type="number" 
                        name="correct_order" 
                        id="correct_order"
                        value="{{ old('correct_order') }}"
                        min="1"
                        :invalid="$errors->has('correct_order')"
                        placeholder="Contoh: 1"
                        required
                    />
                    @error('correct_order')
                        <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-400 font-lato">Urutan snippet dalam puzzle (harus unik).</p>
                </div>

                <div>
                    <label for="content" class="block text-sm font-raleway font-medium text-text-default mb-2">
                        Konten Snippet <span class="text-btn-danger">*</span>
                    </label>
                    <textarea 
                        name="content" 
                        id="content"
                        rows="12"
                        class="block w-full bg-transparent border-b-2 border-border-default text-text-default placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-input-focus rounded-none font-mono text-sm @error('content') invalid @enderror"
                        placeholder="Contoh: <html>...</html>"
                        required
                    >{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-400 font-lato">Potongan HTML/kode yang akan disusun.</p>
                </div>

                <div class="flex items-center gap-3 pt-6 border-t border-border-default">
                    <x-button type="submit" variant="primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Snippet
                    </x-button>
                    <x-button href="{{ route('operator.manage.snippets.index') }}" variant="outlined">
                        Batal
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-operator-layout>
