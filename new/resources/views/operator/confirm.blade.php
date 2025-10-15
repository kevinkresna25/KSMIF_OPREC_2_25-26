<x-operator-layout title="Konfirmasi Potongan — {{ $team->name }}">
    <h1 class="text-2xl md:text-3xl font-pixel text-text-glow pixel-glow uppercase mb-2">
        Konfirmasi Potongan
    </h1>
    <p class="text-lg text-btn-submit font-raleway font-semibold mb-6">{{ $team->name }}</p>

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
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
    @endif

    <x-card>
        @if ($submissions->count())
            <div class="mb-4">
                <x-alert type="info">
                    <strong class="font-raleway">Petunjuk:</strong> <span class="font-lato">Pilih SATU potongan yang benar untuk tim ini.</span>
                    @if($currentConfirmed)
                        <br><span class="font-lato">Saat ini yang terpilih: <strong>#{{ $currentConfirmed->id }}</strong></span>
                    @endif
                </x-alert>
            </div>

            <form method="POST" action="{{ route('operator.confirm.process', $team) }}" class="space-y-4">
                @csrf

                @foreach ($submissions as $s)
                    <div class="border-2 rounded-none p-4 hover:bg-bg-main/20 transition cursor-pointer
                                {{ $currentConfirmed && $currentConfirmed->id === $s->id ? 'border-text-glow bg-text-glow/10' : 'border-border-default' }}">
                        <label class="flex items-start gap-3 cursor-pointer">
                            {{-- Radio Button (single choice) --}}
                            <input 
                                type="radio" 
                                name="submission_id" 
                                value="{{ $s->id }}"
                                class="mt-1 h-5 w-5 rounded-full border-border-default text-btn-submit focus:ring-btn-submit bg-transparent"
                                @checked(old('submission_id', $currentConfirmed?->id) == $s->id)
                                required
                            >
                            
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-raleway font-medium text-text-default">
                                        Submission #{{ $s->id }}
                                    </span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs text-gray-400 font-lato">
                                            {{ $s->created_at->format('d M Y H:i') }}
                                        </span>
                                        @if ($s->is_confirmed)
                                            <x-badge variant="success">
                                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Terpilih
                                            </x-badge>
                                        @else
                                            <x-badge variant="default">Belum Terpilih</x-badge>
                                        @endif
                                    </div>
                                </div>
                                
                                {{-- Content Preview --}}
                                <div class="mt-2 p-3 bg-bg-main/50 rounded-none border border-border-default">
                                    <pre class="text-sm overflow-x-auto text-text-default whitespace-pre-wrap font-mono"><code>{{ Str::limit($s->content, 500, ' ...') }}</code></pre>
                                </div>

                                @if(strlen($s->content) > 500)
                                    <button 
                                        type="button"
                                        onclick="toggleFullContent({{ $s->id }})"
                                        class="mt-2 text-xs text-text-glow hover:text-text-glow/80 font-raleway font-medium">
                                        Lihat selengkapnya
                                    </button>
                                    
                                    <div id="full-content-{{ $s->id }}" class="hidden mt-2 p-3 bg-bg-main/50 rounded-none border border-border-default">
                                        <pre class="text-sm overflow-x-auto text-text-default whitespace-pre-wrap font-mono"><code>{{ $s->content }}</code></pre>
                                    </div>
                                @endif
                            </div>
                        </label>
                    </div>
                @endforeach

                <div class="pt-6 border-t border-border-default">
                    <x-button type="submit" variant="primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Konfirmasi Pilihan
                    </x-button>
                </div>
            </form>
        @else
            <x-alert type="warning">
                Belum ada potongan untuk tim ini.
            </x-alert>
        @endif
    </x-card>

    @push('scripts')
    <script>
        function toggleFullContent(id) {
            const element = document.getElementById(`full-content-${id}`);
            element.classList.toggle('hidden');
            
            const button = event.target;
            button.textContent = element.classList.contains('hidden') ? 'Lihat selengkapnya' : 'Sembunyikan';
        }

        // Highlight selected radio on label click
        document.querySelectorAll('label').forEach(label => {
            label.addEventListener('click', function() {
                document.querySelectorAll('.border-2.rounded-none').forEach(div => {
                    div.classList.remove('border-text-glow', 'bg-text-glow/10');
                    div.classList.add('border-border-default');
                });
                
                const parent = this.closest('.border-2.rounded-none');
                if (parent) {
                    parent.classList.add('border-text-glow', 'bg-text-glow/10');
                    parent.classList.remove('border-border-default');
                }
            });
        });
    </script>
    @endpush
</x-operator-layout>
