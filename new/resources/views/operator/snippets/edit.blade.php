<x-operator-layout title="Edit Snippet #{{ $snippet->correct_order }}">
        <x-card>
            <div class="mb-6">
                <h2 class="text-2xl font-pixel text-text-glow pixel-glow uppercase">Edit Snippet</h2>
                <p class="text-text-default mt-2 font-lato">Perbarui potongan kode/HTML.</p>
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

            <form method="POST" action="{{ route('operator.manage.snippets.update', $snippet) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="correct_order" class="block text-sm font-raleway font-medium text-text-default mb-2">
                        Urutan yang Benar <span class="text-btn-danger">*</span>
                    </label>
                    <x-input 
                        type="number" 
                        name="correct_order" 
                        id="correct_order"
                        value="{{ old('correct_order', $snippet->correct_order) }}"
                        min="1"
                        :invalid="$errors->has('correct_order')"
                        required
                    />
                    @error('correct_order')
                        <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                    @enderror
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
                        required
                    >{{ old('content', $snippet->content) }}</textarea>
                    @error('content')
                        <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3 pt-6 border-t border-border-default">
                    <x-button type="submit" variant="primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Perbarui Snippet
                    </x-button>
                    <x-button href="{{ route('operator.manage.snippets.index') }}" variant="outlined">
                        Batal
                    </x-button>
                </div>
            </form>

            {{-- Delete Section --}}
            <div class="mt-8 pt-8 border-t border-btn-danger">
                <h3 class="text-lg font-raleway font-semibold text-btn-danger mb-2">Danger Zone</h3>
                <p class="text-sm text-gray-400 mb-4 font-lato">Hapus snippet ini. Aksi ini tidak dapat dibatalkan.</p>
                <form method="POST" action="{{ route('operator.manage.snippets.destroy', $snippet) }}" 
                      onsubmit="return confirm('Yakin ingin menghapus snippet ini?');">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Snippet
                    </x-button>
                </form>
            </div>
        </x-card>
    </div>
</x-operator-layout>
