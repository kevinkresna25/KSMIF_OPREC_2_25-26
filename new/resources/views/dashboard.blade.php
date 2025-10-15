<x-operator-layout title="OPERATOR DASHBOARD">
    {{-- Flash Messages --}}
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

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        {{-- Total Teams --}}
        <x-card class="border-btn-info/50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-raleway text-gray-400 uppercase tracking-wider">Total Tim</p>
                    <p class="text-3xl font-pixel text-btn-info mt-2">{{ $progress['total_teams'] }}</p>
                </div>
                <div class="w-12 h-12 bg-btn-info/20 rounded-none flex items-center justify-center">
                    <svg class="w-6 h-6 text-btn-info" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </x-card>

        {{-- Confirmed Teams --}}
        <x-card class="border-btn-solved/50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-raleway text-gray-400 uppercase tracking-wider">Terkonfirmasi</p>
                    <p class="text-3xl font-pixel text-btn-solved mt-2">{{ $progress['confirmed_teams'] }}</p>
                </div>
                <div class="w-12 h-12 bg-btn-solved/20 rounded-none flex items-center justify-center">
                    <svg class="w-6 h-6 text-btn-solved" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </x-card>

        {{-- Remaining Teams --}}
        <x-card class="border-yellow-500/50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-raleway text-gray-400 uppercase tracking-wider">Tersisa</p>
                    <p class="text-3xl font-pixel text-yellow-500 mt-2">{{ $progress['remaining_teams'] }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-none flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </x-card>

        {{-- Progress Percentage --}}
        <x-card class="border-text-glow/50 bg-gradient-to-br from-btn-submit/20 to-text-glow/20">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-raleway text-gray-400 uppercase tracking-wider">Progress</p>
                    <p class="text-3xl font-pixel text-text-glow pixel-glow mt-2">{{ $progress['percentage'] }}%</p>
                </div>
                <div class="w-12 h-12 bg-text-glow/20 rounded-none flex items-center justify-center">
                    <svg class="w-6 h-6 text-text-glow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </x-card>
    </div>

    {{-- Progress Bar Card --}}
    <x-card class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-pixel text-sm text-text-glow pixel-glow uppercase">Progress Konfirmasi</h2>
            @if($progress['is_complete'])
                <x-button variant="solved" class="text-xs px-4 py-1">Selesai</x-button>
            @else
                <x-button variant="info" class="text-xs px-4 py-1">Dalam Progress</x-button>
            @endif
        </div>

        <div class="space-y-4">
            {{-- Progress Bar --}}
            <div class="relative">
                <div class="w-full bg-gray-700 rounded-none h-6 overflow-hidden">
                    <div class="bg-gradient-to-r from-btn-submit to-text-glow h-6 rounded-none transition-all duration-500 flex items-center justify-center" 
                         style="width: {{ $progress['percentage'] }}%">
                        @if($progress['percentage'] > 15)
                            <span class="text-xs font-pixel text-white">{{ $progress['percentage'] }}%</span>
                        @endif
                    </div>
                </div>
                @if($progress['percentage'] <= 15 && $progress['percentage'] > 0)
                    <span class="absolute left-2 top-1/2 -translate-y-1/2 text-xs font-pixel text-gray-300">{{ $progress['percentage'] }}%</span>
                @endif
            </div>

            {{-- Status Message --}}
            @if($progress['is_complete'])
                <x-alert type="success">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-raleway font-semibold">Semua tim sudah dikonfirmasi!</p>
                            <p class="text-sm mt-1">Klik tombol di bawah untuk mulai menyusun urutan.</p>
                        </div>
                        <x-button variant="success" :href="route('operator.arrange.show')" class="ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                            Susun Urutan
                        </x-button>
                    </div>
                </x-alert>
            @elseif($progress['confirmed_teams'] > 0)
                <x-alert type="info">
                    Masih ada <strong>{{ $progress['remaining_teams'] }} tim</strong> yang belum dikonfirmasi. Lanjutkan konfirmasi untuk melanjutkan.
                </x-alert>
            @else
                <x-alert type="warning">
                    Belum ada tim yang dikonfirmasi. Mulai dengan mengkonfirmasi potongan dari setiap tim.
                </x-alert>
            @endif
        </div>
    </x-card>

    {{-- Teams Without Confirmation Alert --}}
    @if($teamsWithoutConfirmation->count() > 0)
        <x-card class="border-yellow-500/50 mb-6">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-10 h-10 bg-yellow-500/20 rounded-none flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-pixel text-xs text-yellow-500 uppercase mb-2">Tim Belum Dikonfirmasi</h3>
                    <p class="text-sm text-gray-300 font-raleway">Klik tombol konfirmasi untuk memilih potongan dari tim berikut:</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach($teamsWithoutConfirmation as $team)
                    <div class="flex items-center justify-between p-4 bg-bg-navbar border border-yellow-500/30 rounded-none hover:border-yellow-500 transition group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-yellow-500/20 rounded-none flex items-center justify-center group-hover:bg-yellow-500/30 transition">
                                <span class="font-pixel text-xs text-yellow-500">{{ substr($team->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-raleway font-semibold text-gray-200">{{ $team->name }}</p>
                                <span class="text-xs text-yellow-500 font-raleway uppercase">Menunggu</span>
                            </div>
                        </div>
                        <x-button variant="info" :href="route('operator.confirm.show', $team)" class="text-xs px-3 py-1">
                            Konfirmasi
                        </x-button>
                    </div>
                @endforeach
            </div>
        </x-card>
    @endif

    {{-- All Teams Table --}}
    <x-card>
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-pixel text-sm text-text-glow pixel-glow uppercase">Semua Tim</h2>
            <x-button variant="submit" :href="route('operator.manage.teams.create')" class="text-xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Tim
            </x-button>
        </div>

        @if ($teams->count())
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-bg-navbar">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-pixel text-gray-400 uppercase">Tim</th>
                            <th class="px-6 py-3 text-left text-xs font-pixel text-gray-400 uppercase">Inputan</th>
                            <th class="px-6 py-3 text-left text-xs font-pixel text-gray-400 uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-pixel text-gray-400 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach ($teams as $team)
                            <tr class="hover:bg-bg-navbar/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-btn-info/20 rounded-none flex items-center justify-center">
                                            <span class="font-pixel text-xs text-btn-info">{{ substr($team->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <div class="font-raleway font-semibold text-gray-200">{{ $team->name }}</div>
                                            <div class="text-xs text-gray-500 font-lato">ID: #{{ $team->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-raleway text-gray-300">
                                        <span class="font-bold">{{ $team->submissions_count }}</span> inputan
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($team->submissions->count() > 0)
                                        <x-button variant="solved" class="text-xs px-3 py-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Terkonfirmasi
                                        </x-button>
                                    @else
                                        <x-button variant="outlined" class="text-xs px-3 py-1">Belum</x-button>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <x-button variant="info" :href="route('operator.confirm.show', $team)" class="text-xs px-3 py-1">
                                            {{ $team->submissions->count() > 0 ? 'Ubah' : 'Konfirmasi' }}
                                        </x-button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-12 text-center">
                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <p class="text-gray-400 font-raleway font-semibold mb-2">Belum ada tim</p>
                <p class="text-sm text-gray-500 font-lato mb-4">Tambahkan tim pertama untuk memulai.</p>
                <x-button variant="submit" :href="route('operator.manage.teams.create')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Tim
                </x-button>
            </div>
        @endif
    </x-card>
</x-operator-layout>
