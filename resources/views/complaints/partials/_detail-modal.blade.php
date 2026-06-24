{{-- Detail Modal Overlay (shared by Lacak Status & Landing Page) --}}
<div id="detail-modal" class="fixed inset-0 z-[100] hidden">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeDetailModal()"></div>

    {{-- Modal Content --}}
    <div class="relative flex items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-2xl rounded-2xl overflow-hidden shadow-2xl">
            <div class="relative bg-white max-h-[90vh] overflow-y-auto overflow-x-hidden" id="detail-modal-content">

                {{-- Header: ticket code kiri, close kanan --}}
                <div class="flex items-center justify-between px-7 sm:px-8 pt-6 pb-4">
                    <span id="modal-ticket" class="text-sm font-mono text-gray-500 font-semibold"></span>
                    <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Loading state --}}
                <div id="modal-loading" class="flex items-center justify-center py-20">
                    <div class="w-8 h-8 border-4 border-primary/20 border-t-primary rounded-full animate-spin"></div>
                </div>

                {{-- Content (filled by JS) --}}
                <div id="modal-body" class="hidden">
                    {{-- Photo --}}
                    <div class="relative aspect-video bg-gray-200 mx-6 sm:mx-8 rounded-xl overflow-hidden">
                        <img id="modal-photo" src="" alt="" class="w-full h-full object-cover">
                    </div>

                    <div class="p-6 sm:p-8">
                        {{-- Category & Status --}}
                        <div class="flex items-center justify-between mb-3">
                            <span id="modal-category-badge" class="flex items-center gap-1 text-xs text-gray-500 border border-gray-200 rounded-full px-2.5 py-0.5">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                </svg>
                            </span>
                            <span id="modal-status-badge" class="text-xs font-semibold px-2.5 py-0.5 rounded-full"></span>
                        </div>

                        {{-- Title & Meta --}}
                        <h2 id="modal-title" class="text-xl sm:text-2xl font-bold text-gray-900 mb-2"></h2>
                        {{-- Description --}}
                        <p id="modal-description" class="text-sm text-gray-600 leading-relaxed mb-2"></p>
                        <div class="flex flex-wrap items-center gap-2 text-xs text-gray-400 mb-4">
                            <span id="modal-location" class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                Warga Anonim
                            </span>
                            <span id="modal-time" class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </span>
                        </div>

                        {{-- Upvote Section --}}
                        <div id="upvote-section" class="bg-gray-50 border border-gray-200 rounded-xl p-4 mb-6">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-semibold text-gray-700 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                    </svg>
                                    <span id="upvote-display-count">0</span> warga mendukung laporan ini
                                </span>
                            </div>
                            {{-- Upvote Form (inline) --}}
                            <div id="upvote-form-wrapper">
                                <div class="flex flex-col gap-2">
                                    <input type="email" id="upvote-email" placeholder="Masukkan email kamu"
                                        class="w-full rounded-lg border-gray-300 text-sm py-2 px-3 focus:border-primary focus:ring-primary">
                                    <button id="upvote-btn" onclick="submitUpvote()"
                                        class="w-full bg-primary text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors">
                                        Saya Juga Mengalami Ini
                                    </button>
                                </div>
                                <p id="upvote-message" class="text-xs mt-2 hidden"></p>
                            </div>
                            {{-- Already voted state --}}
                            <div id="upvote-done" class="hidden">
                                <div class="flex items-center gap-2 text-sm text-green-600 font-medium">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
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
                    const svgTag = catBadge.querySelector('svg').outerHTML;
                    catBadge.innerHTML = `${svgTag} ${data.category_label}`;
                    catBadge.className = `flex items-center gap-1 text-xs text-gray-500 border border-gray-200 rounded-full px-2.5 py-0.5`;
                    const statusBadge = document.getElementById('modal-status-badge');
                    statusBadge.textContent = data.status_label;
                    statusBadge.className = `${data.status_color} text-xs font-semibold px-2.5 py-0.5 rounded-full`;

                    // Title & meta
                    document.getElementById('modal-title').textContent = data.title;
                    document.getElementById('modal-location').innerHTML = `<svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg> ${data.address || 'Lokasi tidak tersedia'}`;
                    document.getElementById('modal-time').innerHTML = `<svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg> ${data.created_at}`;
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
                            let photoHtml = r.photo_url ? `<img src="${r.photo_url}" alt="Bukti" class="mt-3 rounded-lg w-full max-h-64 object-cover">` : '';
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
                    body: JSON.stringify({
                        email
                    }),
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