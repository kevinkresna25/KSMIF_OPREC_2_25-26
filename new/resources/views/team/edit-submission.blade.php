<x-layouts.retro :show-nav="false" :show-footer="false">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">
            {{-- Header --}}
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl md:text-4xl font-pixel text-text-glow pixel-glow uppercase">
                        Edit Submission
                    </h1>
                    <p class="text-gray-400 mt-2 font-lato">
                        Update your code submission
                    </p>
                </div>
                <x-button variant="outlined" :href="route('team.submissions')">
                    ← Back
                </x-button>
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
            @if ($errors->any())
                <x-alert type="error" class="mb-6">
                    <ul class="list-disc ms-5 text-sm">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </x-alert>
            @endif

            {{-- Submission Info --}}
            <x-card class="mb-6">
                <h3 class="text-sm font-lato text-gray-400 mb-2">Submission Details</h3>
                <div class="flex items-center justify-between text-sm">
                    <div>
                        <span class="text-gray-500">Created:</span>
                        <span class="text-text-default ml-2">{{ $submission->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Last Updated:</span>
                        <span class="text-text-default ml-2">{{ $submission->updated_at->format('d M Y H:i') }}</span>
                    </div>
                    <x-badge variant="warning">Pending</x-badge>
                </div>
            </x-card>

            {{-- Edit Form --}}
            <x-card>
                <form method="POST" action="{{ route('submission.update', $submission) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-sm font-raleway font-medium text-text-default mb-2">
                            Potongan Kode (hasil dekripsi)
                            <span class="text-red-400">*</span>
                        </label>
                        <textarea 
                            name="content" 
                            rows="12"
                            class="block w-full bg-transparent border-b-2 border-border-default text-text-default placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-input-focus rounded-none font-mono text-sm"
                            placeholder="Tempel potongan HTML hasil dekripsi di sini..." 
                            required
                        >{{ old('content', $submission->content) }}</textarea>
                        <p class="text-xs text-gray-400 mt-2 font-lato">
                            Minimum 10 characters, maximum 10,000 characters.
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <x-button type="submit" variant="submit">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Submission
                        </x-button>

                        <x-button type="button" variant="outlined" onclick="window.history.back()">
                            Cancel
                        </x-button>

                        <div class="flex-1"></div>

                        <form method="POST" action="{{ route('submission.destroy', $submission) }}" 
                            onsubmit="return confirm('Are you sure you want to delete this submission?');" 
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <x-button type="submit" variant="danger">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete
                            </x-button>
                        </form>
                    </div>
                </form>
            </x-card>

            {{-- Help Text --}}
            <x-card class="mt-6 bg-blue-900/20 border-blue-500/30">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 text-blue-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-sm text-gray-300 font-lato">
                        <p class="font-semibold mb-2">Note:</p>
                        <ul class="list-disc ml-5 space-y-1">
                            <li>You can only edit submissions that haven't been confirmed yet.</li>
                            <li>Once a submission is confirmed by an operator, it cannot be edited or deleted.</li>
                            <li>The system will check for duplicates when you update.</li>
                        </ul>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
</x-layouts.retro>

