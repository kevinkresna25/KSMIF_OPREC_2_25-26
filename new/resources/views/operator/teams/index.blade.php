<x-operator-layout title="Kelola Tim">
    {{-- Flash Messages --}}
    @if (session('success'))
        <x-alert type="success" class="mb-6">
            {{ session('success') }}
        </x-alert>
    @endif

    {{-- Header with Actions --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-pixel text-text-glow pixel-glow uppercase">Kelola Tim</h2>
            <p class="text-text-default mt-2 font-lato">Manage all teams and their submissions</p>
        </div>
        <x-button href="{{ route('operator.manage.teams.create') }}" variant="primary">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Tim Baru
        </x-button>
    </div>

    {{-- Teams Grid --}}
    @if ($teams->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            @foreach ($teams as $team)
                <x-card class="hover:border-text-glow transition-all duration-300">
                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-btn-info to-btn-submit rounded-none flex items-center justify-center text-white font-bold text-xl shadow-lg border border-border-default">
                            {{ substr($team->name, 0, 1) }}
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('operator.manage.teams.edit', $team) }}" 
                               class="p-2 text-text-default hover:bg-border-default hover:text-bg-main rounded-none transition border border-border-default">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('operator.manage.teams.destroy', $team) }}" 
                                  onsubmit="return confirm('Yakin ingin menghapus tim ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-btn-danger hover:bg-btn-danger hover:text-white rounded-none transition border border-btn-danger">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Team Name --}}
                    <h3 class="text-lg font-raleway font-semibold text-text-default mb-2">{{ $team->name }}</h3>
                    <p class="text-sm text-gray-400 mb-4 font-mono">ID: #{{ $team->id }}</p>

                    {{-- Stats --}}
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <div class="bg-btn-submit/20 rounded-none p-3 border border-btn-submit/30">
                            <p class="text-xs text-btn-submit font-medium font-raleway">Total Inputan</p>
                            <p class="text-2xl font-bold text-btn-submit">{{ $team->submissions_count }}</p>
                        </div>
                        <div class="bg-btn-success/20 rounded-none p-3 border border-btn-success/30">
                            <p class="text-xs text-btn-success font-medium font-raleway">Terkonfirmasi</p>
                            <p class="text-2xl font-bold text-btn-success">{{ $team->submissions->where('is_confirmed', true)->count() }}</p>
                        </div>
                    </div>

                    {{-- Status --}}
                    @if($team->submissions->where('is_confirmed', true)->count() > 0)
                        <x-badge variant="success" class="w-full justify-center">
                            <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Sudah Dikonfirmasi
                        </x-badge>
                    @else
                        <x-badge variant="warning" class="w-full justify-center">
                            Belum Dikonfirmasi
                        </x-badge>
                    @endif

                    {{-- Actions --}}
                    <div class="mt-4 pt-4 border-t border-border-default">
                        <x-button href="{{ route('operator.confirm.show', $team) }}" variant="outlined" class="w-full justify-center text-sm">
                            {{ $team->submissions->where('is_confirmed', true)->count() > 0 ? 'Ubah Konfirmasi' : 'Konfirmasi Sekarang' }}
                        </x-button>
                    </div>
                </x-card>
            @endforeach
        </div>

        {{-- Pagination --}}
        <x-card>
            {{ $teams->links() }}
        </x-card>
    @else
        <x-card class="p-12 text-center">
            <svg class="w-20 h-20 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <p class="text-xl font-raleway font-semibold text-text-default mb-2">Belum Ada Tim</p>
            <p class="text-gray-400 mb-6 font-lato">Tambahkan tim pertama untuk memulai.</p>
            <x-button href="{{ route('operator.manage.teams.create') }}" variant="primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Tim Baru
            </x-button>
        </x-card>
    @endif
</x-operator-layout>
