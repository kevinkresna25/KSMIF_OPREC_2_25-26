<x-layouts.retro :show-nav="false" :show-footer="false">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-5xl mx-auto">
            {{-- Team Info & Logout --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-pixel text-text-glow pixel-glow uppercase">
                        Input Potongan
                    </h1>
                    <p class="text-gray-400 mt-2 font-lato">
                        Tim: <span class="text-text-default font-semibold">{{ auth()->guard('team')->user()->name }}</span>
                    </p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-button type="submit" variant="danger">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </x-button>
                </form>
            </div>

            {{-- Alerts --}}
            @if (session('success'))
                <x-alert type="success" class="mb-4">
                    {{ session('success') }}
                </x-alert>
            @endif
            @if (session('error'))
                <x-alert type="error" class="mb-4">
                    {{ session('error') }}
                </x-alert>
            @endif
            @if ($errors->any())
                <x-alert type="error" class="mb-4">
                    <ul class="list-disc ms-5 text-sm">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </x-alert>
            @endif

            <x-card class="mb-8">
                <form method="POST" action="{{ route('submission.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-raleway font-medium text-text-default mb-2">Potongan Kode (hasil dekripsi)</label>
                        <textarea name="content" rows="6"
                            class="block w-full bg-transparent border-b-2 border-border-default text-text-default placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-input-focus rounded-none font-mono text-sm"
                            placeholder="Tempel potongan HTML hasil dekripsi di sini..." required>{{ old('content') }}</textarea>
                        <p class="text-xs text-gray-400 mt-2 font-lato">Potongan kode akan otomatis tersimpan untuk tim Anda.</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <x-button type="submit" variant="primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Potongan
                        </x-button>
                    </div>
                </form>
            </x-card>

            {{-- Daftar potongan SEMUA tim --}}
            <div class="mt-10">
                <div class="flex items-end justify-between gap-4 mb-4 flex-wrap">
                    <h2 class="text-xl font-raleway font-semibold text-text-default">Potongan Tersimpan (Semua Tim)</h2>
                    <form method="GET" class="flex items-center gap-2 flex-wrap">
                        <x-input name="q" value="{{ $q ?? '' }}" placeholder="Cari konten / nama tim" class="min-w-[200px]" />
                        <select name="per_page"
                            class="rounded-none border-b-2 border-border-default bg-transparent text-text-default focus:outline-none focus:border-input-focus">
                            @foreach ([10, 15, 25, 50] as $pp)
                                <option value="{{ $pp }}" @selected(($perPage ?? 10) == $pp)>{{ $pp }}/hal
                                </option>
                            @endforeach
                        </select>
                        <x-button type="submit" variant="outlined">Cari</x-button>
                    </form>
                </div>

                @if ($allSubmissions->count())
                    <ul class="space-y-3">
                        @foreach ($allSubmissions as $sub)
                            <x-card>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-gray-400 font-lato">
                                        {{ $sub->team?->name ?? 'Unknown Team' }} •
                                        {{ $sub->created_at->format('d M Y H:i') }}
                                    </span>
                                    @if ($sub->is_confirmed)
                                        <x-badge variant="success">Confirmed</x-badge>
                                    @else
                                        <x-badge variant="warning">Pending</x-badge>
                                    @endif
                                </div>
                                <pre class="text-sm overflow-x-auto text-text-default font-mono bg-bg-main/50 p-3 rounded-none border border-border-default"><code>{{ $sub->content }}</code></pre>
                            </x-card>
                        @endforeach
                    </ul>

                    <div class="mt-6">
                        {{ $allSubmissions->onEachSide(1)->links() }}
                    </div>
                @else
                    <x-card class="text-center">
                        <p class="text-gray-400 font-lato">Belum ada potongan dari tim manapun.</p>
                    </x-card>
                @endif
            </div>
        </div>
    </div>

    {{-- Prevent browser back button after logout --}}
    <script>
        // Prevent back button navigation
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1);
        };
        
        // Force reload if page loaded from browser cache
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>
</x-layouts.retro>
