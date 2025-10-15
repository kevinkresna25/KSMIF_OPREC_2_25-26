<x-operator-layout title="Kelola Inputan">
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

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-pixel text-text-glow pixel-glow uppercase">Kelola Inputan</h2>
        <p class="text-text-default mt-2 font-lato">Manage semua inputan dari tim. <strong class="text-btn-danger">Note:</strong> Hanya bisa menghapus, tidak bisa edit (untuk fairness).</p>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-raleway font-medium text-gray-400">Total Inputan</p>
                    <p class="text-3xl font-bold text-text-default mt-2">{{ $stats['total'] }}</p>
                </div>
                <div class="w-12 h-12 bg-btn-submit/20 rounded-none flex items-center justify-center border border-btn-submit">
                    <svg class="w-6 h-6 text-btn-submit" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-raleway font-medium text-gray-400">Terkonfirmasi</p>
                    <p class="text-3xl font-bold text-btn-success mt-2">{{ $stats['confirmed'] }}</p>
                </div>
                <div class="w-12 h-12 bg-btn-success/20 rounded-none flex items-center justify-center border border-btn-success">
                    <svg class="w-6 h-6 text-btn-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-raleway font-medium text-gray-400">Pending</p>
                    <p class="text-3xl font-bold text-yellow-500 mt-2">{{ $stats['pending'] }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-none flex items-center justify-center border border-yellow-500">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </x-card>
    </div>

    {{-- Filters --}}
    <x-card class="mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            {{-- Team Filter --}}
            <div>
                <label class="block text-sm font-raleway font-medium text-text-default mb-2">Filter Tim</label>
                <select name="team_id" class="w-full rounded-none border-b-2 border-border-default bg-transparent text-text-default focus:outline-none focus:border-input-focus">
                    <option value="">Semua Tim</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" @selected($selectedTeamId == $team->id)>{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Status Filter --}}
            <div>
                <label class="block text-sm font-raleway font-medium text-text-default mb-2">Status</label>
                <select name="status" class="w-full rounded-none border-b-2 border-border-default bg-transparent text-text-default focus:outline-none focus:border-input-focus">
                    <option value="">Semua Status</option>
                    <option value="confirmed" @selected($status === 'confirmed')>Terkonfirmasi</option>
                    <option value="pending" @selected($status === 'pending')>Pending</option>
                </select>
            </div>

            {{-- Search --}}
            <div>
                <label class="block text-sm font-raleway font-medium text-text-default mb-2">Search</label>
                <x-input type="text" name="search" value="{{ $search }}" placeholder="Cari konten..." />
            </div>

            {{-- Submit --}}
            <div class="flex items-end">
                <x-button type="submit" variant="primary" class="w-full justify-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Filter
                </x-button>
            </div>
        </form>
    </x-card>

    {{-- Submissions List --}}
    @if ($submissions->count())
        <x-card class="mb-6">
            {{-- Bulk Actions --}}
            <div class="px-6 py-4 border-b border-border-default flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="selectAll" class="rounded-none border-border-default text-btn-submit focus:ring-btn-submit bg-transparent">
                    <label for="selectAll" class="text-sm font-raleway font-medium text-text-default">Pilih Semua</label>
                </div>
                <button onclick="bulkDelete()" 
                        class="hidden items-center gap-2 px-4 py-2 bg-btn-danger text-white rounded-none hover:bg-btn-danger/80 transition text-sm font-pixel uppercase"
                        id="bulkDeleteBtn">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Terpilih
                </button>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-border-default">
                    <thead class="bg-bg-navbar">
                        <tr>
                            <th class="px-6 py-3 text-left w-12">
                                <span class="sr-only">Select</span>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-raleway font-medium text-text-default uppercase tracking-wider">
                                Tim
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-raleway font-medium text-text-default uppercase tracking-wider">
                                Konten
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-raleway font-medium text-text-default uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-raleway font-medium text-text-default uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-raleway font-medium text-text-default uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-default">
                        @foreach ($submissions as $submission)
                            <tr class="hover:bg-bg-main/30 transition">
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="submission-checkbox rounded-none border-border-default text-btn-submit focus:ring-btn-submit bg-transparent" 
                                           value="{{ $submission->id }}">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-btn-info/20 rounded-none flex items-center justify-center border border-btn-info">
                                            <span class="font-bold text-btn-info">{{ substr($submission->team->name ?? 'U', 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <div class="font-raleway font-medium text-text-default">{{ $submission->team->name ?? 'Unknown' }}</div>
                                            <div class="text-sm text-gray-400 font-mono">ID: #{{ $submission->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-md">
                                        <pre class="text-sm text-text-default font-mono bg-bg-main/50 p-2 rounded-none border border-border-default overflow-x-auto"><code>{{ \Illuminate\Support\Str::limit($submission->content, 150, ' ...') }}</code></pre>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($submission->is_confirmed)
                                        <x-badge variant="success">Terkonfirmasi</x-badge>
                                    @else
                                        <x-badge variant="warning">Pending</x-badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 font-lato">
                                    {{ $submission->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <form method="POST" action="{{ route('operator.manage.submissions.destroy', $submission) }}" 
                                          onsubmit="return confirm('Yakin ingin menghapus inputan ini?');" 
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center gap-1 px-3 py-1.5 text-btn-danger hover:bg-btn-danger/20 rounded-none transition text-sm font-medium border border-btn-danger">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-border-default">
                {{ $submissions->links() }}
            </div>
        </x-card>
    @else
        <x-card class="p-12 text-center">
            <svg class="w-20 h-20 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="text-xl font-raleway font-semibold text-text-default mb-2">Tidak Ada Inputan</p>
            <p class="text-gray-400 font-lato">Belum ada inputan dengan filter yang dipilih.</p>
        </x-card>
    @endif

    {{-- Bulk Delete Form (Hidden) --}}
    <form id="bulkDeleteForm" method="POST" action="{{ route('operator.manage.submissions.bulk-destroy') }}" class="hidden">
        @csrf
        <input type="hidden" name="submission_ids" id="bulkDeleteIds">
    </form>

    @push('scripts')
    <script>
        // Select all checkbox
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.submission-checkbox');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');

        selectAll?.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateBulkDeleteButton();
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateBulkDeleteButton);
        });

        function updateBulkDeleteButton() {
            const checkedCount = document.querySelectorAll('.submission-checkbox:checked').length;
            if (checkedCount > 0) {
                bulkDeleteBtn.classList.remove('hidden');
                bulkDeleteBtn.classList.add('flex');
            } else {
                bulkDeleteBtn.classList.add('hidden');
                bulkDeleteBtn.classList.remove('flex');
            }
        }

        function bulkDelete() {
            const checked = Array.from(document.querySelectorAll('.submission-checkbox:checked'))
                .map(cb => cb.value);
            
            if (checked.length === 0) {
                alert('Pilih minimal 1 inputan untuk dihapus.');
                return;
            }

            if (!confirm(`Yakin ingin menghapus ${checked.length} inputan terpilih?`)) {
                return;
            }

            document.getElementById('bulkDeleteIds').value = JSON.stringify(checked);
            document.getElementById('bulkDeleteForm').submit();
        }
    </script>
    @endpush
</x-operator-layout>
