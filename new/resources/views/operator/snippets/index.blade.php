<x-operator-layout title="Kelola Snippet">
    {{-- Flash Messages --}}
    @if (session('success'))
        <x-alert type="success" class="mb-6">
            {{ session('success') }}
        </x-alert>
    @endif

    {{-- Header with Actions --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-pixel text-text-glow pixel-glow uppercase">Kelola Snippet</h2>
            <p class="text-text-default mt-2 font-lato">Manage HTML/code snippets yang menjadi jawaban puzzle</p>
        </div>
        <x-button href="{{ route('operator.manage.snippets.create') }}" variant="primary">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Snippet
        </x-button>
    </div>

    {{-- Snippets List --}}
    @if ($snippets->count())
        <x-card class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-border-default">
                    <thead class="bg-bg-navbar">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-raleway font-medium text-text-default uppercase tracking-wider w-24">
                                Urutan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-raleway font-medium text-text-default uppercase tracking-wider">
                                Konten
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-raleway font-medium text-text-default uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-default">
                        @foreach ($snippets as $snippet)
                            <tr class="hover:bg-bg-main/30 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-10 h-10 bg-btn-info/20 rounded-none flex items-center justify-center border border-btn-info">
                                            <span class="font-bold text-btn-info">#{{ $snippet->correct_order }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-2xl">
                                        <pre class="text-sm text-text-default font-mono bg-bg-main/50 p-3 rounded-none border border-border-default overflow-x-auto"><code>{{ \Illuminate\Support\Str::limit($snippet->content, 200, ' ...') }}</code></pre>
                                        @if(strlen($snippet->content) > 200)
                                            <button 
                                                onclick="showPreview({{ $snippet->id }}, {{ json_encode($snippet->content) }})"
                                                class="mt-2 text-xs text-text-glow hover:text-text-glow/80 font-medium font-raleway">
                                                Lihat selengkapnya
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button 
                                            onclick="showPreview({{ $snippet->id }}, {{ json_encode($snippet->content) }})"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-btn-submit hover:bg-btn-submit/20 rounded-none transition text-sm font-medium border border-btn-submit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Preview
                                        </button>
                                        <a href="{{ route('operator.manage.snippets.edit', $snippet) }}" 
                                           class="inline-flex items-center gap-1 px-3 py-1.5 text-btn-info hover:bg-btn-info/20 rounded-none transition text-sm font-medium border border-btn-info">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('operator.manage.snippets.destroy', $snippet) }}" 
                                              onsubmit="return confirm('Yakin ingin menghapus snippet ini?');" 
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-border-default">
                {{ $snippets->links() }}
            </div>
        </x-card>
    @else
        <x-card class="p-12 text-center">
            <svg class="w-20 h-20 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
            </svg>
            <p class="text-xl font-raleway font-semibold text-text-default mb-2">Belum Ada Snippet</p>
            <p class="text-gray-400 mb-6 font-lato">Tambahkan snippet pertama sebagai master data puzzle.</p>
            <x-button href="{{ route('operator.manage.snippets.create') }}" variant="primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Snippet
            </x-button>
        </x-card>
    @endif

    {{-- Preview Modal --}}
    <div id="previewModal" class="fixed inset-0 hidden items-center justify-center bg-black/70 z-50 backdrop-blur-sm" onclick="hidePreview(event)">
        <div class="bg-bg-card rounded-none shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-hidden flex flex-col border-2 border-text-glow" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between px-6 py-4 border-b border-border-default bg-bg-navbar">
                <h3 class="font-pixel text-text-glow pixel-glow uppercase text-sm">Preview</h3>
                <button onclick="hidePreview()" class="text-text-default hover:text-btn-danger text-2xl leading-none transition">
                    &times;
                </button>
            </div>
            <div class="p-6 overflow-y-auto flex-1">
                <div class="bg-bg-main rounded-none p-4 border border-border-default">
                    <pre id="previewContent" class="text-sm text-btn-success font-mono overflow-x-auto"><code></code></pre>
                </div>
            </div>
            <div class="flex justify-end gap-2 px-6 py-4 border-t border-border-default bg-bg-navbar">
                <x-button onclick="hidePreview()" variant="outlined">
                    Tutup
                </x-button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function showPreview(id, content) {
            const modal = document.getElementById('previewModal');
            const previewContent = document.getElementById('previewContent');
            
            previewContent.textContent = content;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function hidePreview(event) {
            if (event && event.target !== event.currentTarget) return;
            
            const modal = document.getElementById('previewModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
    @endpush
</x-operator-layout>
