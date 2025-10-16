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
    <div id="previewModal" class="fixed inset-0 hidden items-center justify-center bg-black/70 z-50 backdrop-blur-sm p-4">
        <div class="bg-bg-card rounded-none shadow-xl w-full max-w-7xl max-h-[95vh] overflow-hidden flex flex-col border-2" id="modalContainer">
            {{-- Header with Status --}}
            <div class="flex items-center justify-between px-5 py-3 border-b border-border-default" id="modalHeader">
                <div class="flex items-center gap-3">
                    <svg id="modalIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 id="modalTitle" class="font-pixel uppercase text-sm"></h3>
                </div>
                <button id="closeModal" class="text-text-default hover:text-btn-danger text-2xl leading-none transition">
                    &times;
                </button>
            </div>

            {{-- Tabs --}}
            <div class="flex border-b border-border-default bg-bg-navbar">
                <button id="tabPreview" class="px-4 py-2 font-raleway font-medium text-sm transition border-b-2 border-text-glow text-text-glow">
                    Preview Render
                </button>
                <button id="tabCode" class="px-4 py-2 font-raleway font-medium text-sm transition border-b-2 border-transparent text-gray-400 hover:text-text-default">
                    Source Code
                </button>
            </div>

            {{-- Content Area --}}
            <div class="flex-1 overflow-hidden bg-bg-main">
                {{-- Preview Tab --}}
                <div id="contentPreview" class="h-full">
                    <iframe id="previewIframe" class="w-full h-full border-0 bg-white" sandbox="allow-scripts"></iframe>
                </div>

                {{-- Code Tab --}}
                <div id="contentCode" class="hidden h-full overflow-auto p-4">
                    <pre id="codeContent" class="text-sm text-text-default font-mono bg-bg-card p-4 rounded border border-border-default overflow-x-auto"><code></code></pre>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-between px-5 py-3 border-t border-border-default bg-bg-navbar">
                <div id="modalMessage" class="text-sm font-lato"></div>
                <x-button id="closeModal2" variant="outlined">
                    Tutup
                </x-button>
            </div>
        </div>
    </div>

    @push('scripts')
    {{-- SortableJS CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js" 
            referrerpolicy="no-referrer"></script>

    <script>
        // Main elements
        const listEl = document.getElementById('snippetList');
        const statusEl = document.getElementById('statusMsg');
        const checkBtn = document.getElementById('checkBtn');

        // Modal elements
        const modal = document.getElementById('previewModal');
        const closeModal = document.getElementById('closeModal');
        const closeModal2 = document.getElementById('closeModal2');
        const modalContainer = document.getElementById('modalContainer');
        const modalHeader = document.getElementById('modalHeader');
        const modalIcon = document.getElementById('modalIcon');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');

        // Tab elements
        const tabPreview = document.getElementById('tabPreview');
        const tabCode = document.getElementById('tabCode');
        const contentPreview = document.getElementById('contentPreview');
        const contentCode = document.getElementById('contentCode');
        const previewIframe = document.getElementById('previewIframe');
        const codeContent = document.getElementById('codeContent');

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Debug: Log all elements on page load
        console.log('🔧 Element initialization check:');
        console.log('✓ listEl:', listEl);
        console.log('✓ modal:', modal);
        console.log('✓ modalContainer:', modalContainer);
        console.log('✓ checkBtn:', checkBtn);

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

        // Tab switching
        function switchTab(tab) {
            if (tab === 'preview') {
                tabPreview.classList.add('border-text-glow', 'text-text-glow');
                tabPreview.classList.remove('border-transparent', 'text-gray-400');
                tabCode.classList.remove('border-text-glow', 'text-text-glow');
                tabCode.classList.add('border-transparent', 'text-gray-400');
                contentPreview.classList.remove('hidden');
                contentCode.classList.add('hidden');
            } else {
                tabCode.classList.add('border-text-glow', 'text-text-glow');
                tabCode.classList.remove('border-transparent', 'text-gray-400');
                tabPreview.classList.remove('border-text-glow', 'text-text-glow');
                tabPreview.classList.add('border-transparent', 'text-gray-400');
                contentCode.classList.remove('hidden');
                contentPreview.classList.add('hidden');
            }
        }

        tabPreview && tabPreview.addEventListener('click', () => switchTab('preview'));
        tabCode && tabCode.addEventListener('click', () => switchTab('code'));

        // Modal functions
        function openModal(data) {
            console.log('🎭 openModal called with data:', data);
            
            try {
                const { success, message, html, html_raw } = data;
                
                console.log('🎨 Modal elements check:');
                console.log('- modal:', modal ? '✓' : '✗');
                console.log('- modalContainer:', modalContainer ? '✓' : '✗');
                console.log('- modalHeader:', modalHeader ? '✓' : '✗');
                console.log('- modalIcon:', modalIcon ? '✓' : '✗');
                console.log('- modalTitle:', modalTitle ? '✓' : '✗');
                console.log('- modalMessage:', modalMessage ? '✓' : '✗');
                console.log('- previewIframe:', previewIframe ? '✓' : '✗');
                console.log('- codeContent:', codeContent ? '✓' : '✗');

                if (!modal) {
                    console.error('❌ Modal element not found!');
                    alert('Error: Modal element tidak ditemukan di halaman');
                    return;
                }

                // Set modal styling based on success
                if (success) {
                    console.log('✅ Setting SUCCESS styling');
                    modalContainer.classList.remove('border-btn-danger');
                    modalContainer.classList.add('border-btn-success');
                    modalHeader.classList.remove('bg-btn-danger/20');
                    modalHeader.classList.add('bg-btn-success/20');
                    modalIcon.classList.remove('text-btn-danger');
                    modalIcon.classList.add('text-btn-success');
                    modalTitle.classList.remove('text-btn-danger');
                    modalTitle.classList.add('text-btn-success');
                    modalMessage.classList.remove('text-btn-danger');
                    modalMessage.classList.add('text-btn-success');
                } else {
                    console.log('❌ Setting ERROR styling');
                    modalContainer.classList.remove('border-btn-success');
                    modalContainer.classList.add('border-btn-danger');
                    modalHeader.classList.remove('bg-btn-success/20');
                    modalHeader.classList.add('bg-btn-danger/20');
                    modalIcon.classList.remove('text-btn-success');
                    modalIcon.classList.add('text-btn-danger');
                    modalTitle.classList.remove('text-btn-success');
                    modalTitle.classList.add('text-btn-danger');
                    modalMessage.classList.remove('text-btn-success');
                    modalMessage.classList.add('text-btn-danger');
                }

                // Set content
                const titleText = message || (success ? 'Urutan Benar!' : 'Urutan Belum Sesuai');
                const messageText = success ? '✓ Semua potongan tersusun dengan benar' : '⚠ Silakan susun ulang potongan';
                
                console.log('📝 Setting title:', titleText);
                console.log('📝 Setting message:', messageText);
                
                modalTitle.textContent = titleText;
                modalMessage.textContent = messageText;

                // Render HTML in iframe
                if (html_raw) {
                    console.log('🖼️ Rendering HTML in iframe, length:', html_raw.length);
                    try {
                        const iframeDoc = previewIframe.contentDocument || previewIframe.contentWindow.document;
                        iframeDoc.open();
                        iframeDoc.write(html_raw);
                        iframeDoc.close();
                        console.log('✅ Iframe rendered successfully');
                    } catch (iframeError) {
                        console.error('❌ Error rendering iframe:', iframeError);
                    }
                } else {
                    console.warn('⚠️ No html_raw in response');
                }

                // Show beautified code
                if (html) {
                    console.log('📄 Setting beautified code, length:', html.length);
                    codeContent.textContent = html;
                } else {
                    console.warn('⚠️ No html in response');
                }

                // Show modal
                console.log('👁️ Showing modal...');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                console.log('✅ Modal classes updated - hidden removed, flex added');
                
                // Default to preview tab
                switchTab('preview');
                console.log('✅ Switched to preview tab');
                console.log('🎉 Modal should be visible now!');
                
            } catch (error) {
                console.error('💥 Error in openModal:', error);
                alert('Error saat membuka modal: ' + error.message);
            }
        }

        function hideModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            
            // Clear iframe
            const iframeDoc = previewIframe.contentDocument || previewIframe.contentWindow.document;
            if (iframeDoc) {
                iframeDoc.open();
                iframeDoc.write('');
                iframeDoc.close();
            }
            
            codeContent.textContent = '';
        }

        [closeModal, closeModal2].forEach(btn => btn && btn.addEventListener('click', hideModal));
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
            console.log('🔍 Tombol check diklik');
            setStatus('');
            const order = currentOrder();

            console.log('📋 Current order:', order.length + ' items');

            if (!order.length) {
                setStatus('Tidak ada potongan untuk dicek.', true);
                return;
            }

            try {
                setStatus('Memeriksa urutan dan memproses HTML...');
                checkBtn.disabled = true;
                checkBtn.classList.add('opacity-50', 'cursor-not-allowed');

                console.log('🌐 Mengirim request ke server...');
                const res = await fetch('{{ route('operator.arrange.check') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ order }),
                });

                console.log('📡 Response status:', res.status);
                const data = await res.json();
                console.log('📦 Response data:', data);

                if (!res.ok) {
                    console.error('❌ Response not OK');
                    setStatus(data?.message || 'Terjadi kesalahan saat memeriksa.', true);
                    return;
                }

                // Always show the modal with preview
                console.log('✅ Akan menampilkan modal...');
                setStatus('');
                openModal(data);

            } catch (err) {
                console.error('💥 Error:', err);
                setStatus('Gagal menghubungi server.', true);
            } finally {
                checkBtn.disabled = false;
                checkBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        });
    </script>
    @endpush
</x-operator-layout>
