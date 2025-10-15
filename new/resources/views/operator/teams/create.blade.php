<x-operator-layout title="Tambah Tim Baru">
        <x-card>
            <div class="mb-6">
                <h2 class="text-2xl font-pixel text-text-glow pixel-glow uppercase">Tambah Tim</h2>
                <p class="text-text-default mt-2 font-lato">Isi formulir di bawah untuk menambahkan tim baru.</p>
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

            <form method="POST" action="{{ route('operator.manage.teams.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-raleway font-medium text-text-default mb-2">
                        Nama Tim <span class="text-btn-danger">*</span>
                    </label>
                    <x-input 
                        type="text" 
                        name="name" 
                        id="name"
                        value="{{ old('name') }}"
                        :invalid="$errors->has('name')"
                        placeholder="Contoh: Team Alpha"
                        required
                        autofocus
                    />
                    @error('name')
                        <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-400 font-lato">Nama tim harus unik dan mudah diingat.</p>
                </div>

                <div>
                    <label for="username" class="block text-sm font-raleway font-medium text-text-default mb-2">
                        Username <span class="text-btn-danger">*</span>
                    </label>
                    <x-input 
                        type="text" 
                        name="username" 
                        id="username"
                        value="{{ old('username') }}"
                        :invalid="$errors->has('username')"
                        placeholder="Contoh: alpha"
                        required
                    />
                    @error('username')
                        <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-400 font-lato">Username untuk login tim (tanpa spasi, huruf kecil).</p>
                </div>

                <div>
                    <label for="password" class="block text-sm font-raleway font-medium text-text-default mb-2">
                        Password <span class="text-btn-danger">*</span>
                    </label>
                    <x-input 
                        type="password" 
                        name="password" 
                        id="password"
                        :invalid="$errors->has('password')"
                        placeholder="Minimal 8 karakter"
                        required
                    />
                    @error('password')
                        <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-400 font-lato">Password yang akan digunakan tim untuk login.</p>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-raleway font-medium text-text-default mb-2">
                        Konfirmasi Password <span class="text-btn-danger">*</span>
                    </label>
                    <x-input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation"
                        :invalid="$errors->has('password_confirmation')"
                        placeholder="Ketik ulang password"
                        required
                    />
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-btn-danger font-lato">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3 pt-6 border-t border-border-default">
                    <x-button type="submit" variant="primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Tim
                    </x-button>
                    <x-button href="{{ route('operator.manage.teams.index') }}" variant="outlined">
                        Batal
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-operator-layout>

