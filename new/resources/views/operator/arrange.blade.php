<x-operator-layout title="Penyusunan Potongan — Semua Tim">
    <h1 class="text-2xl md:text-3xl font-pixel text-text-glow pixel-glow uppercase mb-2">
        Penyusunan Potongan
    </h1>
    <p class="text-gray-400 mb-6 font-lato">Susun urutan yang benar dari semua potongan terkonfirmasi</p>

    @if (session('success'))
        <x-alert type="success" class="mb-4">
            {{ session('success') }}
        </x-alert>
    @endif

    <x-card>
        <x-alert type="info" class="mb-4">
            <strong class="font-raleway">Petunjuk:</strong> <span class="font-lato">Seret dan urutkan {{ $confirmedSubmissions->count() }} potongan berikut hingga sesuai urutan yang benar, lalu klik <strong>Cek Susunan</strong>.</span>
        </x-alert>

        @if ($confirmedSubmissions->count())
            <div class="mb-4 p-4 bg-btn-submit/10 border-2 border-btn-submit rounded-none">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-raleway font-semibold text-btn-submit">Total Potongan Terkonfirmasi</p>
                        <p class="text-sm text-gray-400 font-lato">{{ $confirmedSubmissions->count() }} potongan dari {{ $confirmedSubmissions->count() }} tim</p>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-btn-submit">{{ $confirmedSubmissions->count() }}</p>
                        <p class="text-xs text-gray-400 font-pixel uppercase">Pieces</p>
                    </div>
                </div>
            </div>

            <ul id="snippetList" class="space-y-3 mb-6">
                @foreach ($confirmedSubmissions as $item)
                    <li class="p-4 rounded-none border-2 border-border-default bg-bg-card hover:bg-bg-main/30 cursor-move transition-all 
                               hover:border-text-glow hover:shadow-lg hover:shadow-text-glow/20 group" 
                        data-content="{{ e($item->content) }}"
                        data-team-id="{{ $item->team_id }}">
                        <div class="flex items-start gap-3">
                            {{-- Drag Handle --}}
                            <div class="text-gray-500 group-hover:text-text-glow transition pt-1">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                </svg>
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-raleway font-medium text-text-default">
                                            {{ $item->team->name }}
                                        </span>
                                        <x-badge variant="success">
                                            <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Terkonfirmasi
                                        </x-badge>
                                    </div>
                                    <span class="text-xs text-gray-400 font-lato">
                                        Submission #{{ $item->id }}
                                    </span>
                                </div>
                                
                                {{-- Content Preview --}}
                                <div class="p-3 bg-bg-main/50 rounded-none border border-border-default">
                                    <pre class="text-sm overflow-x-auto text-text-default whitespace-pre-wrap font-mono"><code>{{ \Illuminate\Support\Str::limit($item->content, 300, ' …') }}</code></pre>
                                </div>

                                @if(strlen($item->content) > 300)
                                    <button 
                                        type="button"
                                        onclick="toggleContent({{ $item->id }})"
                                        class="mt-2 text-xs text-text-glow hover:text-text-glow/80 font-raleway font-medium">
                                        Lihat selengkapnya
                                    </button>
                                    
                                    <div id="full-{{ $item->id }}" class="hidden mt-2 p-3 bg-bg-main/50 rounded-none border border-border-default">
                                        <pre class="text-sm overflow-x-auto text-text-default whitespace-pre-wrap font-mono"><code>{{ $item->content }}</code></pre>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="pt-6 border-t border-border-default">
                <div class="flex items-center gap-3">
                    <x-button id="checkBtn" type="button" variant="primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Cek Susunan
                    </x-button>
                    <span id="statusMsg" class="text-sm text-gray-400 font-lato"></span>
                </div>
            </div>
        @else
            <x-alert type="warning">
                Belum ada potongan yang dikonfirmasi dari semua tim.
            </x-alert>
        @endif
    </x-card>

    {{-- Modal Preview HTML --}}
    <div id="previewModal" class="fixed inset-0 hidden items-center justify-center bg-black/80 z-50 backdrop-blur-sm p-4">
        <div class="bg-bg-card rounded-none shadow-xl w-full mx-4 max-h-[95vh] overflow-hidden flex flex-col border-2" style="max-width: 90vw;" id="modalContainer">
            {{-- Header with dynamic status --}}
            <div class="flex items-center justify-between px-5 py-3 border-b border-border-default" id="modalHeader">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6" id="modalIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="font-pixel uppercase text-sm" id="modalTitle">Preview HTML</h3>
                </div>
                <button id="closeModal" class="text-text-default hover:text-btn-danger text-2xl leading-none transition">
                    &times;
                </button>
            </div>
            
            {{-- Tabs --}}
            <div class="flex border-b border-border-default bg-bg-navbar">
                <button id="tabPreview" class="tab-btn px-6 py-3 font-raleway font-semibold text-sm uppercase transition-colors border-b-2 border-btn-info text-btn-info">
                    Preview
                </button>
                <button id="tabSource" class="tab-btn px-6 py-3 font-raleway font-semibold text-sm uppercase transition-colors border-b-2 border-transparent text-gray-400 hover:text-text-default">
                    Source Code
                </button>
            </div>

            {{-- Tab Content: Preview --}}
            <div id="contentPreview" class="flex-1 overflow-hidden bg-white">
                <iframe id="previewFrame" class="w-full h-full border-0" sandbox="allow-scripts"></iframe>
            </div>

            {{-- Tab Content: Source Code --}}
            <div id="contentSource" class="hidden flex-1 overflow-y-auto bg-bg-main p-5">
                <pre class="text-xs text-text-default font-mono whitespace-pre-wrap" id="sourceCode"></pre>
            </div>

            {{-- Footer --}}
            <div class="flex justify-between items-center gap-2 px-5 py-3 border-t border-border-default bg-bg-navbar">
                <div id="statusMessage" class="text-sm font-raleway"></div>
                <x-button id="closeModal2" variant="outlined">
                    Tutup
                </x-button>
            </div>
        </div>
    </div>

    @push('scripts')
    {{-- SortableJS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/dompurify@3.0.6/dist/purify.min.js" 
            integrity="sha256-2Qhbt4+LQtiqB5h4rXEvQHnG8H2JQvaYcwrcJ5x4SWA=" 
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js" 
            referrerpolicy="no-referrer"></script>
    {{-- JS Beautify for HTML formatting --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.11/beautify-html.min.js"></script>

    <script>
        const listEl = document.getElementById('snippetList');
        const statusEl = document.getElementById('statusMsg');
        const checkBtn = document.getElementById('checkBtn');

        const modal = document.getElementById('previewModal');
        const modalContainer = document.getElementById('modalContainer');
        const modalHeader = document.getElementById('modalHeader');
        const modalTitle = document.getElementById('modalTitle');
        const modalIcon = document.getElementById('modalIcon');
        const statusMessage = document.getElementById('statusMessage');
        const closeModalBtn = document.getElementById('closeModal');
        const closeModal2Btn = document.getElementById('closeModal2');
        
        const previewFrame = document.getElementById('previewFrame');
        const sourceCode = document.getElementById('sourceCode');
        
        const tabPreview = document.getElementById('tabPreview');
        const tabSource = document.getElementById('tabSource');
        const contentPreview = document.getElementById('contentPreview');
        const contentSource = document.getElementById('contentSource');

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function setStatus(msg, isError = false) {
            if (!statusEl) return;
            statusEl.textContent = msg || '';
            statusEl.className = 'text-sm font-lato ' + (isError ? 'text-btn-danger font-medium' : 'text-gray-400');
        }

        // Initialize SortableJS
        if (listEl) {
            new Sortable(listEl, {
                animation: 200,
                ghostClass: 'opacity-50',
                dragClass: 'shadow-xl',
                handle: 'li',
                onStart: function() {
                    setStatus('Sedang menyusun...');
                },
                onEnd: function() {
                    setStatus('');
                }
            });
        }

        // Get current order
        function currentOrder() {
            return Array.from(document.querySelectorAll('#snippetList > li'))
                .map(li => li.getAttribute('data-content') || '');
        }

        // Beautify HTML
        function beautifyHtml(html) {
            try {
                return html_beautify(html, {
                    indent_size: 2,
                    indent_char: ' ',
                    max_preserve_newlines: 1,
                    preserve_newlines: true,
                    keep_array_indentation: false,
                    break_chained_methods: false,
                    indent_scripts: 'normal',
                    brace_style: 'collapse',
                    space_before_conditional: true,
                    unescape_strings: false,
                    jslint_happy: false,
                    end_with_newline: false,
                    wrap_line_length: 0,
                    indent_inner_html: true,
                    comma_first: false,
                    e4x: false,
                    indent_empty_lines: false
                });
            } catch (e) {
                console.error('Beautify error:', e);
                return html;
            }
        }

        // Modal functions
        function openModal(html, isSuccess, message) {
            // Beautify HTML
            const beautifiedHtml = beautifyHtml(html);
            
            // Update modal styling based on success
            if (isSuccess) {
                modalContainer.className = 'bg-bg-card rounded-none shadow-xl w-full mx-4 max-h-[95vh] overflow-hidden flex flex-col border-2 border-btn-success';
                modalHeader.className = 'flex items-center justify-between px-5 py-3 border-b border-border-default bg-btn-success/20';
                modalIcon.className = 'w-6 h-6 text-btn-success';
                modalTitle.className = 'font-pixel uppercase text-sm text-btn-success';
                modalTitle.textContent = 'Selamat! Urutan Benar!';
                statusMessage.className = 'text-sm font-raleway text-btn-success font-semibold';
            } else {
                modalContainer.className = 'bg-bg-card rounded-none shadow-xl w-full mx-4 max-h-[95vh] overflow-hidden flex flex-col border-2 border-btn-danger';
                modalHeader.className = 'flex items-center justify-between px-5 py-3 border-b border-border-default bg-btn-danger/20';
                modalIcon.className = 'w-6 h-6 text-btn-danger';
                modalTitle.className = 'font-pixel uppercase text-sm text-btn-danger';
                modalTitle.textContent = 'Urutan Belum Sesuai';
                statusMessage.className = 'text-sm font-raleway text-btn-danger font-semibold';
            }
            
            statusMessage.textContent = message;
            
            // Update icon
            if (isSuccess) {
                modalIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
            } else {
                modalIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
            }
            
            // Render in iframe
            const iframeDoc = previewFrame.contentDocument || previewFrame.contentWindow.document;
            iframeDoc.open();
            iframeDoc.write(beautifiedHtml);
            iframeDoc.close();
            
            // Show source code
            sourceCode.textContent = beautifiedHtml;
            
            // Show preview tab by default
            showPreviewTab();
            
            // Show modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function hideModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            
            // Clear iframe
            const iframeDoc = previewFrame.contentDocument || previewFrame.contentWindow.document;
            iframeDoc.open();
            iframeDoc.write('');
            iframeDoc.close();
            
            sourceCode.textContent = '';
        }

        function showPreviewTab() {
            contentPreview.classList.remove('hidden');
            contentSource.classList.add('hidden');
            tabPreview.className = 'tab-btn px-6 py-3 font-raleway font-semibold text-sm uppercase transition-colors border-b-2 border-btn-info text-btn-info';
            tabSource.className = 'tab-btn px-6 py-3 font-raleway font-semibold text-sm uppercase transition-colors border-b-2 border-transparent text-gray-400 hover:text-text-default';
        }

        function showSourceTab() {
            contentPreview.classList.add('hidden');
            contentSource.classList.remove('hidden');
            tabSource.className = 'tab-btn px-6 py-3 font-raleway font-semibold text-sm uppercase transition-colors border-b-2 border-btn-info text-btn-info';
            tabPreview.className = 'tab-btn px-6 py-3 font-raleway font-semibold text-sm uppercase transition-colors border-b-2 border-transparent text-gray-400 hover:text-text-default';
        }

        // Tab event listeners
        tabPreview?.addEventListener('click', showPreviewTab);
        tabSource?.addEventListener('click', showSourceTab);

        [closeModalBtn, closeModal2Btn].forEach(btn => btn && btn.addEventListener('click', hideModal));
        modal && modal.addEventListener('click', (e) => {
            if (e.target === modal) hideModal();
        });

        // Toggle content
        function toggleContent(id) {
            const element = document.getElementById(`full-${id}`);
            element.classList.toggle('hidden');
            
            const button = event.target;
            button.textContent = element.classList.contains('hidden') ? 'Lihat selengkapnya' : 'Sembunyikan';
        }

        // Check order
        checkBtn && checkBtn.addEventListener('click', async () => {
            setStatus('');
            const order = currentOrder();

            if (!order.length) {
                setStatus('Tidak ada potongan untuk dicek.', true);
                return;
            }

            try {
                setStatus('Memeriksa urutan...');
                checkBtn.disabled = true;
                checkBtn.classList.add('opacity-50', 'cursor-not-allowed');

                const res = await fetch('{{ route('operator.arrange.check') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ order }),
                });

                const data = await res.json();

                // Always show modal with preview (success or error)
                if (data.html) {
                    setStatus('');
                    setTimeout(() => {
                        openModal(data.html, data.success, data.message || 'Preview HTML');
                    }, 300);
                } else {
                    setStatus(data?.message || 'Terjadi kesalahan saat memeriksa.', true);
                }
            } catch (err) {
                console.error(err);
                setStatus('Gagal menghubungi server.', true);
            } finally {
                checkBtn.disabled = false;
                checkBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        });
    </script>
    @endpush
</x-operator-layout>
