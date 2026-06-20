{{-- Detail Modal Overlay (shared by Lacak Status & Landing Page) --}}
<div id="detail-modal" class="fixed inset-0 z-[100] hidden">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeDetailModal()"></div>

    {{-- Modal Content --}}
    <div class="relative flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto" id="detail-modal-content">
            {{-- Close button --}}
            <button onclick="closeDetailModal()" class="absolute top-4 right-4 z-10 p-2 bg-white/80 backdrop-blur rounded-full hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            {{-- Loading state --}}
            <div id="modal-loading" class="flex items-center justify-center py-20">
                <div class="w-8 h-8 border-4 border-primary/20 border-t-primary rounded-full animate-spin"></div>
            </div>

            {{-- Content (filled by JS) --}}
            <div id="modal-body" class="hidden">
                {{-- Photo --}}
                <div class="relative aspect-video bg-gray-200 rounded-t-2xl overflow-hidden">
                    <img id="modal-photo" src="" alt="" class="w-full h-full object-cover">
                    <div class="absolute top-3 left-3"><span id="modal-category-badge" class="text-[11px] font-semibold px-2.5 py-1 rounded-full"></span></div>
                    <div class="absolute top-3 right-3"><span id="modal-status-badge" class="text-xs font-semibold px-2.5 py-0.5 rounded-full"></span></div>
                </div>

                <div class="p-6 sm:p-8">
                    {{-- Title & Meta --}}
                    <h2 id="modal-title" class="text-xl sm:text-2xl font-bold text-gray-900 mb-2"></h2>
                    <div class="flex flex-wrap items-center gap-3 text-xs text-gray-400 mb-4">
                        <span id="modal-location" class="flex items-center gap-1">📍</span>
                        <span class="flex items-center gap-1">👤 Warga Anonim</span>
                        <span id="modal-time" class="flex items-center gap-1">🕐</span>
                        <span id="modal-ticket" class="font-mono"></span>
                    </div>

                    {{-- Description --}}
                    <p id="modal-description" class="text-sm text-gray-600 leading-relaxed mb-6"></p>

                    {{-- Upvote Section --}}
                    <div id="upvote-section" class="bg-gray-50 border border-gray-200 rounded-xl p-4 mb-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-semibold text-gray-700">👍 <span id="upvote-display-count">0</span> warga mendukung laporan ini</span>
                        </div>
                        {{-- Upvote Form (inline) --}}
                        <div id="upvote-form-wrapper">
                            <div class="flex gap-2">
                                <input type="email" id="upvote-email" placeholder="Masukkan email kamu"
                                    class="flex-1 rounded-lg border-gray-300 text-sm py-2 px-3 focus:border-primary focus:ring-primary">
                                <button id="upvote-btn" onclick="submitUpvote()"
                                    class="bg-primary text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors whitespace-nowrap">
                                    Saya Juga Mengalami Ini
                                </button>
                            </div>
                            <p id="upvote-message" class="text-xs mt-2 hidden"></p>
                        </div>
                        {{-- Already voted state --}}
                        <div id="upvote-done" class="hidden">
                            <div class="flex items-center gap-2 text-sm text-green-600 font-medium">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                Kamu sudah mendukung laporan ini
                            </div>
                        </div>
                    </div>

                    {{-- Progress Timeline --}}
                    <div class="mb-6">
                        <h3 class="text-sm font-bold text-gray-700 mb-3">Progres Status</h3>
                        <div id="modal-timeline" class="flex items-center gap-0"></div>
                    </div>

                    {{-- Responses --}}
                    <div id="modal-responses-section">
                        <h3 class="text-sm font-bold text-gray-700 mb-3">Tanggapan</h3>
                        <div id="modal-responses" class="space-y-3"></div>
                        <p id="modal-no-responses" class="text-sm text-gray-400 italic hidden">Belum ada tanggapan dari petugas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentComplaintId = null;

function openDetailModal(id) {
    currentComplaintId = id;
    const modal = document.getElementById('detail-modal');
    const loading = document.getElementById('modal-loading');
    const body = document.getElementById('modal-body');

    modal.classList.remove('hidden');
    loading.classList.remove('hidden');
    body.classList.add('hidden');
    document.body.style.overflow = 'hidden';

    fetch(`/aduan/${id}`)
        .then(r => r.json())
        .then(data => {
            // Photo & badges
            document.getElementById('modal-photo').src = data.photo_url;
            const catBadge = document.getElementById('modal-category-badge');
            catBadge.textContent = data.category_label;
            catBadge.className = `${data.category_color} text-[11px] font-semibold px-2.5 py-1 rounded-full`;
            const statusBadge = document.getElementById('modal-status-badge');
            statusBadge.textContent = data.status_label;
            statusBadge.className = `${data.status_color} text-xs font-semibold px-2.5 py-0.5 rounded-full`;

            // Title & meta
            document.getElementById('modal-title').textContent = data.title;
            document.getElementById('modal-location').innerHTML = `📍 ${data.address || 'Lokasi tidak tersedia'}`;
            document.getElementById('modal-time').innerHTML = `🕐 ${data.created_at}`;
            document.getElementById('modal-ticket').textContent = data.ticket_code;
            document.getElementById('modal-description').textContent = data.description;

            // Upvote
            document.getElementById('upvote-display-count').textContent = data.upvote_count;
            const lsKey = `upvoted_${data.ticket_code}`;
            if (localStorage.getItem(lsKey)) {
                document.getElementById('upvote-form-wrapper').classList.add('hidden');
                document.getElementById('upvote-done').classList.remove('hidden');
            } else {
                document.getElementById('upvote-form-wrapper').classList.remove('hidden');
                document.getElementById('upvote-done').classList.add('hidden');
            }
            document.getElementById('upvote-message').classList.add('hidden');
            document.getElementById('upvote-email').value = '';

            // Timeline
            renderTimeline(data.status);

            // Responses
            const respContainer = document.getElementById('modal-responses');
            const noResp = document.getElementById('modal-no-responses');
            respContainer.innerHTML = '';
            if (data.responses.length === 0) {
                noResp.classList.remove('hidden');
            } else {
                noResp.classList.add('hidden');
                data.responses.forEach(r => {
                    let photoHtml = r.photo_url ? `<img src="${r.photo_url}" alt="Bukti" class="mt-2 rounded-lg max-h-40 object-cover">` : '';
                    respContainer.innerHTML += `
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-semibold text-primary">Petugas · ${r.status}</span>
                                <span class="text-xs text-gray-400">${r.created_at}</span>
                            </div>
                            ${r.message ? `<p class="text-sm text-gray-600">${r.message}</p>` : '<p class="text-sm text-gray-400 italic">Tidak ada pesan.</p>'}
                            ${photoHtml}
                        </div>`;
                });
            }

            loading.classList.add('hidden');
            body.classList.remove('hidden');
        });
}

function closeDetailModal() {
    document.getElementById('detail-modal').classList.add('hidden');
    document.body.style.overflow = '';
    currentComplaintId = null;
}

function renderTimeline(status) {
    const container = document.getElementById('modal-timeline');
    const steps = ['pending', 'diproses', 'selesai'];
    const isRejected = status === 'ditolak';
    const currentIdx = steps.indexOf(status);

    let html = '';
    steps.forEach((step, i) => {
        const isActive = isRejected ? i === 0 : i <= currentIdx;
        const dotColor = isActive ? 'bg-primary' : 'bg-gray-300';
        const textColor = isActive ? 'text-primary font-semibold' : 'text-gray-400';
        const lineColor = (isRejected ? false : i < currentIdx) ? 'bg-primary' : 'bg-gray-200';

        html += `<div class="flex items-center ${i < steps.length - 1 ? 'flex-1' : ''}">
            <div class="flex flex-col items-center">
                <div class="w-4 h-4 rounded-full ${dotColor} flex items-center justify-center">
                    ${isActive ? '<div class="w-2 h-2 bg-white rounded-full"></div>' : ''}
                </div>
                <span class="text-[10px] ${textColor} mt-1 whitespace-nowrap">${step.charAt(0).toUpperCase() + step.slice(1)}</span>
            </div>
            ${i < steps.length - 1 ? `<div class="flex-1 h-0.5 ${lineColor} mx-1 mt-[-14px]"></div>` : ''}
        </div>`;
    });

    if (isRejected) {
        html += `<div class="flex items-center">
            <div class="flex-1 h-0.5 bg-red-300 mx-1 mt-[-14px]"></div>
            <div class="flex flex-col items-center">
                <div class="w-4 h-4 rounded-full bg-red-500 flex items-center justify-center">
                    <div class="w-2 h-2 bg-white rounded-full"></div>
                </div>
                <span class="text-[10px] text-red-600 font-semibold mt-1">Ditolak</span>
            </div>
        </div>`;
    }

    container.innerHTML = html;
}

function submitUpvote() {
    const email = document.getElementById('upvote-email').value;
    const msgEl = document.getElementById('upvote-message');
    const btn = document.getElementById('upvote-btn');

    if (!email || !email.includes('@')) {
        msgEl.textContent = 'Masukkan email yang valid.';
        msgEl.className = 'text-xs mt-2 text-red-500';
        msgEl.classList.remove('hidden');
        return;
    }

    btn.disabled = true;
    btn.textContent = 'Mengirim...';

    fetch(`/aduan/${currentComplaintId}/upvote`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: JSON.stringify({ email }),
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById('upvote-display-count').textContent = data.upvote_count;

        if (data.success) {
            msgEl.textContent = data.message;
            msgEl.className = 'text-xs mt-2 text-green-600';
            // Save to localStorage
            const ticket = document.getElementById('modal-ticket').textContent;
            localStorage.setItem(`upvoted_${ticket}`, email);
            // Switch to done state
            setTimeout(() => {
                document.getElementById('upvote-form-wrapper').classList.add('hidden');
                document.getElementById('upvote-done').classList.remove('hidden');
            }, 1500);
        } else {
            msgEl.textContent = data.message;
            msgEl.className = 'text-xs mt-2 text-yellow-600';
            btn.disabled = true;
            btn.textContent = 'Sudah Didukung';
            btn.className = 'bg-gray-200 text-gray-500 text-sm font-semibold px-4 py-2 rounded-lg cursor-not-allowed whitespace-nowrap';
        }
        msgEl.classList.remove('hidden');
    })
    .catch(() => {
        msgEl.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
        msgEl.className = 'text-xs mt-2 text-red-500';
        msgEl.classList.remove('hidden');
        btn.disabled = false;
        btn.textContent = 'Saya Juga Mengalami Ini';
    });
}
</script>
