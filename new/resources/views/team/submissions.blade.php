<x-layouts.retro :show-nav="false" :show-footer="false">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-7xl mx-auto">
            {{-- Header --}}
            <div class="flex items-center justify-between mb-8">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="text-4xl">📋</div>
                        <h1 class="text-2xl md:text-3xl font-pixel text-text-glow pixel-glow uppercase">
                            My Submissions
                        </h1>
                    </div>
                    <p class="text-gray-400 font-lato">
                        Kelola dan lihat semua submission kode Anda
                    </p>
                </div>
                <div class="flex gap-2">
                    <x-button variant="outlined" :href="route('submission.create')">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        New Submit
                    </x-button>
                    <x-button variant="outlined" :href="route('team.dashboard')">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
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

            {{-- Filters --}}
            <x-card class="mb-6">
                <form method="GET" class="flex flex-wrap items-end gap-4">
                    {{-- Search --}}
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-lato text-gray-400 mb-2">Search Content</label>
                        <x-input 
                            name="q" 
                            value="{{ request('q') }}" 
                            placeholder="Search in submissions..." 
                        />
                    </div>

                    {{-- Status Filter --}}
                    <div class="min-w-[150px]">
                        <label class="block text-sm font-lato text-gray-400 mb-2">Status</label>
                        <select name="status"
                            class="w-full rounded-none border-b-2 border-border-default bg-transparent text-text-default focus:outline-none focus:border-input-focus px-3 py-2">
                            <option value="">All</option>
                            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                            <option value="confirmed" @selected(request('status') === 'confirmed')>Confirmed</option>
                        </select>
                    </div>

                    {{-- Per Page --}}
                    <div class="min-w-[100px]">
                        <label class="block text-sm font-lato text-gray-400 mb-2">Per Page</label>
                        <select name="per_page"
                            class="w-full rounded-none border-b-2 border-border-default bg-transparent text-text-default focus:outline-none focus:border-input-focus px-3 py-2">
                            @foreach ([10, 25, 50] as $pp)
                                <option value="{{ $pp }}" @selected(request('per_page', 10) == $pp)>{{ $pp }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-2">
                        <x-button type="submit" variant="primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </x-button>
                        <x-button variant="outlined" :href="route('team.submissions')">
                            Clear
                        </x-button>
                    </div>
                </form>
            </x-card>

            {{-- Submissions List --}}
            @if($submissions->count())
                <div class="space-y-4">
                    @foreach($submissions as $submission)
                        <x-card>
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <span class="text-sm text-gray-400 font-lato">
                                        {{ $submission->created_at->format('d M Y H:i') }}
                                    </span>
                                    @if($submission->created_at != $submission->updated_at)
                                        <span class="text-xs text-gray-500 ml-2">
                                            (edited {{ $submission->updated_at->diffForHumans() }})
                                        </span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2">
                                    @if ($submission->is_confirmed)
                                        <x-badge variant="success">Confirmed</x-badge>
                                    @else
                                        <x-badge variant="warning">Pending</x-badge>
                                        
                                        {{-- Delete Button --}}
                                        <form method="POST" action="{{ route('submission.destroy', $submission) }}" 
                                            onsubmit="return confirm('Are you sure you want to delete this submission?');" 
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-button type="submit" variant="danger" size="sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </x-button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            
                            <pre class="text-sm overflow-x-auto text-text-default font-mono bg-bg-main/50 p-4 rounded-none border border-border-default"><code>{{ $submission->content }}</code></pre>
                        </x-card>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $submissions->links() }}
                </div>
            @else
                <x-card class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-400 font-lato mb-4">No submissions found.</p>
                    <x-button variant="submit" :href="route('submission.create')">
                        Create New Submission
                    </x-button>
                </x-card>
            @endif
        </div>
    </div>
</x-layouts.retro>

