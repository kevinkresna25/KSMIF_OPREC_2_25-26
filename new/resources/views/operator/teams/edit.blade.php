<x-operator-layout title="Edit Tim: {{ $team->name }}">
        <x-card>
            <div class="mb-6">
                <h2 class="text-2xl font-pixel text-text-glow pixel-glow uppercase">Edit Tim</h2>
                <p class="text-text-default mt-2 font-lato">Perbarui informasi tim.</p>
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

            <form method="POST" action="{{ route('operator.manage.teams.update', $team) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-raleway font-medium text-text-default mb-2">
                        Nama Tim <span class="text-btn-danger">*</span>
                    </label>
                    <x-input 
                        type="text" 
                        name="name" 
                        id="name"
                        value="{{ old('name', $team->name) }}"
                        :invalid="$errors->has('name')"
                        required
                        autofocus
                    />
                    @error('name')
                        <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="username" class="block text-sm font-raleway font-medium text-text-default mb-2">
                        Username <span class="text-btn-danger">*</span>
                    </label>
                    <x-input 
                        type="text" 
                        name="username" 
                        id="username"
                        value="{{ old('username', $team->username) }}"
                        :invalid="$errors->has('username')"
                        required
                    />
                    @error('username')
                        <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-400 font-lato">Username untuk login tim (tanpa spasi, huruf kecil).</p>
                </div>

                <div>
                    <label for="password" class="block text-sm font-raleway font-medium text-text-default mb-2">
                        Password Baru
                    </label>
                    <x-input 
                        type="password" 
                        name="password" 
                        id="password"
                        :invalid="$errors->has('password')"
                        placeholder="Kosongkan jika tidak ingin mengubah"
                    />
                    @error('password')
                        <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-400 font-lato">Kosongkan jika tidak ingin mengubah password.</p>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-raleway font-medium text-text-default mb-2">
                        Konfirmasi Password Baru
                    </label>
                    <x-input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation"
                        :invalid="$errors->has('password_confirmation')"
                        placeholder="Ketik ulang password baru"
                    />
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Team Stats --}}
                <div class="p-4 bg-bg-main/50 rounded-none border border-border-default">
                    <h3 class="text-sm font-raleway font-semibold text-text-default mb-3">Statistik Tim</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 font-lato">Total Inputan</p>
                            <p class="text-xl font-bold text-text-default">{{ $team->submissions()->count() }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-lato">Terkonfirmasi</p>
                            <p class="text-xl font-bold text-btn-success">{{ $team->submissions()->where('is_confirmed', true)->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-6 border-t border-border-default">
                    <x-button type="submit" variant="primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Perbarui Tim
                    </x-button>
                    <x-button href="{{ route('operator.manage.teams.index') }}" variant="outlined">
                        Batal
                    </x-button>
                </div>
            </form>

            {{-- Delete Section --}}
            <div class="mt-8 pt-8 border-t border-btn-danger">
                <h3 class="text-lg font-raleway font-semibold text-btn-danger mb-2">Danger Zone</h3>
                <p class="text-sm text-gray-400 mb-4 font-lato">Hapus tim ini beserta semua inputannya. Aksi ini tidak dapat dibatalkan.</p>
                <form method="POST" action="{{ route('operator.manage.teams.destroy', $team) }}" 
                      onsubmit="return confirm('Yakin ingin menghapus tim {{ $team->name }}? Semua inputan akan ikut terhapus!');">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Tim
                    </x-button>
                </form>
            </div>
        </x-card>
    </div>
</x-operator-layout>
