{{-- Admin Edit Modal Partial --}}
<div id="admin-edit-modal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeEditModal()"></div>
    <div class="relative flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <button onclick="closeEditModal()" class="absolute top-4 right-4 z-10 p-2 bg-white/80 backdrop-blur rounded-full hover:bg-gray-100">
                <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <div id="edit-modal-loading" class="flex items-center justify-center py-20">
                <div class="w-8 h-8 border-4 border-primary/20 border-t-primary rounded-full animate-spin"></div>
            </div>

            <div id="edit-modal-body" class="hidden">
                {{-- Photo & Info --}}
                <div class="relative aspect-video bg-gray-200 rounded-t-2xl overflow-hidden">
                    <img id="edit-photo" src="" alt="" class="w-full h-full object-cover">
                    <div class="absolute top-3 left-3"><span id="edit-cat-badge" class="text-[11px] font-semibold px-2.5 py-1 rounded-full"></span></div>
                    <div class="absolute top-3 right-3"><span id="edit-status-badge" class="text-xs font-semibold px-2.5 py-0.5 rounded-full"></span></div>
                </div>

                <div class="p-6 sm:p-8">
                    <h2 id="edit-title" class="text-xl font-bold text-gray-900 mb-2"></h2>
                    <div class="flex flex-wrap items-center gap-3 text-xs text-gray-400 mb-2">
                        <span id="edit-location">📍</span>
                        <span id="edit-reporter">👤</span>
                        <span id="edit-time">🕐</span>
                    </div>
                    <p id="edit-ticket" class="text-xs font-mono text-gray-400 mb-3"></p>
                    <p id="edit-description" class="text-sm text-gray-600 leading-relaxed mb-6"></p>

                    {{-- Existing Responses --}}
                    <div id="edit-responses-section" class="mb-6">
                        <h3 class="text-sm font-bold text-gray-700 mb-3">Riwayat Tanggapan</h3>
                        <div id="edit-responses" class="space-y-2 max-h-40 overflow-y-auto"></div>
                    </div>

                    <hr class="border-gray-200 mb-6">

                    {{-- Update Form --}}
                    <form id="edit-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h3 class="text-sm font-bold text-gray-700 mb-4">Ubah Status & Tanggapan</h3>

                        {{-- Status Buttons --}}
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Status Baru</label>
                            <div class="flex flex-wrap gap-2" id="edit-status-buttons">
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" value="pending" class="hidden peer">
                                    <span class="peer-checked:bg-yellow-500 peer-checked:text-white peer-checked:border-yellow-500 inline-block px-4 py-2 rounded-full text-sm font-medium border border-gray-300 text-gray-600 hover:border-yellow-400 transition-colors">Pending</span>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" value="diproses" class="hidden peer">
                                    <span class="peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 inline-block px-4 py-2 rounded-full text-sm font-medium border border-gray-300 text-gray-600 hover:border-blue-400 transition-colors">Diproses</span>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" value="selesai" class="hidden peer">
                                    <span class="peer-checked:bg-green-500 peer-checked:text-white peer-checked:border-green-500 inline-block px-4 py-2 rounded-full text-sm font-medium border border-gray-300 text-gray-600 hover:border-green-400 transition-colors">Selesai</span>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" value="ditolak" class="hidden peer">
                                    <span class="peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 inline-block px-4 py-2 rounded-full text-sm font-medium border border-gray-300 text-gray-600 hover:border-red-400 transition-colors">Ditolak</span>
                                </label>
                            </div>
                        </div>

                        {{-- Message --}}
                        <div class="mb-4">
                            <label for="edit-message" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tanggapan (opsional)</label>
                            <textarea name="message" id="edit-message" rows="3"
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4"
                                placeholder="Tulis tanggapan atau keterangan..."></textarea>
                        </div>

                        {{-- Photo Upload --}}
                        <div class="mb-6">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Foto Bukti Perbaikan (opsional)</label>
                            <input type="file" name="photo" accept="image/jpeg,image/png"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                        </div>

                        <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-xl text-sm shadow-lg shadow-primary/20 hover:bg-primary-600 transition-colors">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openEditModal(id) {
    const modal = document.getElementById('admin-edit-modal');
    const loading = document.getElementById('edit-modal-loading');
    const body = document.getElementById('edit-modal-body');

    modal.classList.remove('hidden');
    loading.classList.remove('hidden');
    body.classList.add('hidden');
    document.body.style.overflow = 'hidden';

    // Set form action
    document.getElementById('edit-form').action = `/admin/dashboard/${id}`;

    fetch(`/aduan/${id}`)
        .then(r => r.json())
        .then(data => {
            document.getElementById('edit-photo').src = data.photo_url;
            const catBadge = document.getElementById('edit-cat-badge');
            catBadge.textContent = data.category_label;
            catBadge.className = `${data.category_color} text-[11px] font-semibold px-2.5 py-1 rounded-full`;
            const stBadge = document.getElementById('edit-status-badge');
            stBadge.textContent = data.status_label;
            stBadge.className = `${data.status_color} text-xs font-semibold px-2.5 py-0.5 rounded-full`;

            document.getElementById('edit-title').textContent = data.title;
            document.getElementById('edit-location').innerHTML = `📍 ${data.address || '-'}`;
            document.getElementById('edit-reporter').innerHTML = `👤 ${data.reporter_name}`;
            document.getElementById('edit-time').innerHTML = `🕐 ${data.created_at}`;
            document.getElementById('edit-ticket').textContent = data.ticket_code;
            document.getElementById('edit-description').textContent = data.description;

            // Pre-select current status
            const radios = document.querySelectorAll('#edit-status-buttons input[name="status"]');
            radios.forEach(r => { r.checked = r.value === data.status; });

            // Responses
            const respEl = document.getElementById('edit-responses');
            respEl.innerHTML = '';
            if (data.responses.length === 0) {
                respEl.innerHTML = '<p class="text-sm text-gray-400 italic">Belum ada tanggapan.</p>';
            } else {
                data.responses.forEach(r => {
                    respEl.innerHTML += `<div class="bg-gray-50 border border-gray-100 rounded-lg p-3">
                        <div class="flex justify-between text-xs mb-1"><span class="font-semibold text-primary">${r.status}</span><span class="text-gray-400">${r.created_at}</span></div>
                        <p class="text-sm text-gray-600">${r.message || '<em class="text-gray-400">Tanpa pesan</em>'}</p>
                    </div>`;
                });
            }

            // Clear form fields
            document.getElementById('edit-message').value = '';

            loading.classList.add('hidden');
            body.classList.remove('hidden');
        });
}

function closeEditModal() {
    document.getElementById('admin-edit-modal').classList.add('hidden');
    document.body.style.overflow = '';
}
</script>
