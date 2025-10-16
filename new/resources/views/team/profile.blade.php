<x-layouts.retro :show-nav="false" :show-footer="false">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">
            {{-- Header --}}
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl md:text-4xl font-pixel text-text-glow pixel-glow uppercase">
                        Team Profile
                    </h1>
                </div>
                <x-button variant="outlined" :href="route('team.dashboard')">
                    ← Back to Dashboard
                </x-button>
            </div>

            {{-- Profile Card --}}
            <x-card class="mb-6">
                <div class="flex items-start gap-6">
                    {{-- Avatar --}}
                    <div class="flex-shrink-0">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <span class="text-4xl font-pixel text-white">{{ substr($team->name, 0, 1) }}</span>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1">
                        <h2 class="text-2xl font-raleway font-bold text-text-default mb-2">{{ $team->name }}</h2>
                        <p class="text-gray-400 font-lato mb-4">
                            <span class="text-sm">Username:</span>
                            <span class="text-text-default font-mono">{{ $team->username }}</span>
                        </p>

                        <div class="grid grid-cols-2 gap-4 mt-6">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Member Since</p>
                                <p class="text-text-default font-lato">{{ $team->created_at->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Last Active</p>
                                <p class="text-text-default font-lato">{{ $team->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>

            {{-- Statistics --}}
            <x-card>
                <h3 class="text-xl font-raleway font-semibold text-text-default mb-6">Statistics</h3>

                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 border border-border-default rounded-none bg-bg-main/30">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="font-lato text-text-default">Total Submissions</span>
                        </div>
                        <span class="text-2xl font-pixel text-text-glow">{{ $stats['total_submissions'] }}</span>
                    </div>

                    <div class="flex items-center justify-between p-4 border border-border-default rounded-none bg-bg-main/30">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-lato text-text-default">Confirmed Submissions</span>
                        </div>
                        <span class="text-2xl font-pixel text-green-400">{{ $stats['confirmed_submissions'] }}</span>
                    </div>

                    <div class="flex items-center justify-between p-4 border border-border-default rounded-none bg-bg-main/30">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-lato text-text-default">Pending Submissions</span>
                        </div>
                        <span class="text-2xl font-pixel text-yellow-400">{{ $stats['pending_submissions'] }}</span>
                    </div>
                </div>

                @if($stats['first_submission'])
                    <div class="mt-6 pt-6 border-t border-border-default">
                        <h4 class="text-sm text-gray-500 uppercase tracking-wider mb-3">Submission Timeline</h4>
                        <div class="flex items-center justify-between text-sm">
                            <div>
                                <p class="text-gray-400">First Submission</p>
                                <p class="text-text-default font-lato">{{ $stats['first_submission']->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400">Latest Submission</p>
                                <p class="text-text-default font-lato">{{ $stats['latest_submission']->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </x-card>
        </div>
    </div>
</x-layouts.retro>

