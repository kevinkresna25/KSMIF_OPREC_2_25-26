<x-layouts.retro :show-nav="false" :show-footer="false">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-7xl mx-auto">
            {{-- Header --}}
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl md:text-4xl font-pixel text-text-glow pixel-glow uppercase">
                        Dashboard
                    </h1>
                    <p class="text-gray-400 mt-2 font-lato">
                        Welcome, <span class="text-text-default font-semibold">{{ $team->name }}</span>!
                    </p>
                </div>
                <div class="flex gap-2">
                    <x-button variant="outlined" :href="route('team.profile')">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile
                    </x-button>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <x-button type="submit" variant="danger">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </x-button>
                    </form>
                </div>
            </div>

            {{-- Statistics Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Total Submissions --}}
                <x-card class="text-center">
                    <div class="flex flex-col items-center">
                        <svg class="w-12 h-12 text-blue-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-3xl font-pixel text-text-glow mb-1">{{ $stats['total_submissions'] }}</h3>
                        <p class="text-gray-400 font-lato text-sm uppercase tracking-wider">Total Submissions</p>
                    </div>
                </x-card>

                {{-- Confirmed --}}
                <x-card class="text-center">
                    <div class="flex flex-col items-center">
                        <svg class="w-12 h-12 text-green-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-3xl font-pixel text-green-400 mb-1">{{ $stats['confirmed_submissions'] }}</h3>
                        <p class="text-gray-400 font-lato text-sm uppercase tracking-wider">Confirmed</p>
                    </div>
                </x-card>

                {{-- Pending --}}
                <x-card class="text-center">
                    <div class="flex flex-col items-center">
                        <svg class="w-12 h-12 text-yellow-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-3xl font-pixel text-yellow-400 mb-1">{{ $stats['pending_submissions'] }}</h3>
                        <p class="text-gray-400 font-lato text-sm uppercase tracking-wider">Pending</p>
                    </div>
                </x-card>
            </div>

            {{-- Quick Actions --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <x-button variant="submit" :href="route('submission.create')" class="h-20 text-lg">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Submit New Code
                </x-button>

                <x-button variant="primary" :href="route('team.submissions')" class="h-20 text-lg">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    View All Submissions
                </x-button>

                <x-button variant="outlined" :href="route('decrypt.show')" class="h-20 text-lg">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                    Decrypt Tool
                </x-button>
            </div>

            {{-- Recent Submissions --}}
            <x-card>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-raleway font-semibold text-text-default">Recent Submissions</h2>
                    <x-button variant="outlined" :href="route('team.submissions')" size="sm">
                        View All →
                    </x-button>
                </div>

                @if($recentSubmissions->count())
                    <div class="space-y-4">
                        @foreach($recentSubmissions as $submission)
                            <div class="border border-border-default p-4 rounded-none bg-bg-main/30">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-gray-400 font-lato">
                                        {{ $submission->created_at->format('d M Y H:i') }}
                                    </span>
                                    <div class="flex items-center gap-2">
                                        @if ($submission->is_confirmed)
                                            <x-badge variant="success">Confirmed</x-badge>
                                        @else
                                            <x-badge variant="warning">Pending</x-badge>
                                            <x-button variant="outlined" size="sm" :href="route('submission.edit', $submission)">
                                                Edit
                                            </x-button>
                                        @endif
                                    </div>
                                </div>
                                <pre class="text-sm overflow-x-auto text-text-default font-mono bg-bg-main/50 p-3 rounded-none border border-border-default max-h-40"><code>{{ Str::limit($submission->content, 200) }}</code></pre>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-400 py-8 font-lato">
                        Belum ada submission. Mulai submit kode sekarang!
                    </p>
                @endif
            </x-card>
        </div>
    </div>
</x-layouts.retro>

