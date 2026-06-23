{{-- Admin Edit Modal Partial --}}
<div id="admin-edit-modal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeEditModal()"></div>
    <div class="relative flex items-center justify-center min-h-screen p-4 sm:p-6">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-xl max-h-[95vh] flex flex-col overflow-hidden">
            
            <div id="edit-modal-loading" class="flex items-center justify-center py-20">
                <div class="w-8 h-8 border-4 border-[#0d6efd]/20 border-t-[#0d6efd] rounded-full animate-spin"></div>
            </div>

            <div id="edit-modal-body" class="hidden flex flex-col max-h-[95vh]">
                
                {{-- Header --}}
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-white z-10 shrink-0">
                    <span id="edit-ticket" class="text-[13px] font-semibold text-gray-500 tracking-wider"></span>
                    <button type="button" onclick="closeEditModal()" class="text-gray-400 hover:text-gray-700 transition-colors p-1">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                {{-- Scrollable Content --}}
                <div class="overflow-y-auto flex-1 p-6">
                    
                    {{-- Photo --}}
                    <div class="relative aspect-[16/9] bg-gray-100 rounded-xl overflow-hidden mb-5">
                        <img id="edit-photo" src="" alt="" class="w-full h-full object-cover">
                    </div>

                    {{-- Info --}}
                    <h2 id="edit-title" class="text-xl font-extrabold text-gray-900 mb-2"></h2>
                    <p id="edit-description" class="text-sm text-gray-600 leading-relaxed mb-4"></p>
                    
                    <div class="flex flex-wrap items-center gap-4 text-xs font-medium text-gray-400 mb-6 pb-6 border-b border-gray-100">
                        <div class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg> <span id="edit-location"></span></div>
                        <div class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg> <span id="edit-reporter"></span></div>
                        <div class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/></svg> <span id="edit-whatsapp"></span></div>
                        <div class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.909A2.25 2.25 0 0 1 2.25 8.993V6.75m19.5 0v.243m0 0a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.909A2.25 2.25 0 0 1 2.25 8.993V6.75"/></svg> <span id="edit-email"></span></div>
                        <div class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg> <span id="edit-time"></span></div>
                    </div>

                    {{-- Form --}}
                    <form id="edit-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Status Selection --}}
                        <div class="mb-6">
                            <label class="block text-[13px] font-bold text-gray-900 mb-3">Ubah Status</label>
                            <div class="flex flex-col sm:flex-row gap-3" id="edit-status-buttons">
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="status" value="pending" class="hidden peer" onchange="updateStatusUI()">
                                    <div class="text-center px-4 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200 peer-checked:bg-[#0d6efd] peer-checked:border-[#0d6efd] peer-checked:text-white border-gray-200 text-gray-500 hover:border-gray-300">Pending</div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="status" value="diproses" class="hidden peer" onchange="updateStatusUI()">
                                    <div class="text-center px-4 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200 peer-checked:bg-[#0d6efd] peer-checked:border-[#0d6efd] peer-checked:text-white border-gray-200 text-gray-500 hover:border-gray-300">Diproses</div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="status" value="selesai" class="hidden peer" onchange="updateStatusUI()">
                                    <div class="text-center px-4 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200 peer-checked:bg-[#0d6efd] peer-checked:border-[#0d6efd] peer-checked:text-white border-gray-200 text-gray-500 hover:border-gray-300">Selesai</div>
                                </label>
                                {{-- Hidden but available --}}
                                <label class="hidden">
                                    <input type="radio" name="status" value="ditolak" class="hidden peer" onchange="updateStatusUI()">
                                    <div class="text-center px-4 py-2.5 rounded-full text-sm font-semibold border peer-checked:bg-red-600 peer-checked:border-red-600 peer-checked:text-white">Ditolak</div>
                                </label>
                            </div>
                        </div>

                        {{-- Message --}}
                        <div class="mb-6">
                            <label for="edit-message" class="block text-[13px] font-bold text-gray-900 mb-2">Tanggapan</label>
                            <textarea name="message" id="edit-message" rows="3"
                                class="w-full rounded-xl border border-gray-200 bg-[#f8f9fa] shadow-sm focus:bg-white focus:border-[#0d6efd] focus:ring-1 focus:ring-[#0d6efd] text-sm py-3 px-4 resize-none transition-colors"
                                placeholder="Tulis tanggapan untuk pelapor..."></textarea>
                        </div>

                        {{-- Photo Upload --}}
                        <div class="mb-2">
                            <label class="block text-[13px] font-bold text-gray-900 mb-2">Foto Bukti Perbaikan (opsional)</label>
                            <div class="relative border-2 border-dashed border-gray-200 rounded-xl bg-[#f8f9fa] hover:bg-[#f0f4ff] hover:border-[#0d6efd]/40 transition-colors group">
                                <input type="file" name="photo" id="photo_upload" accept="image/jpeg,image/png" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="updateFileName(this)">
                                <div class="flex flex-col items-center justify-center py-6 pointer-events-none">
                                    <svg class="w-6 h-6 text-gray-400 group-hover:text-[#0d6efd] mb-2 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"/></svg>
                                    <span class="text-sm font-semibold text-gray-600" id="file-name-text">Unggah foto bukti</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                {{-- Footer Actions --}}
                <div class="px-6 py-4 border-t border-gray-100 bg-white flex gap-3 shrink-0">
                    <button type="button" onclick="closeEditModal()" class="flex-1 bg-white border border-gray-200 text-gray-700 font-bold py-3 rounded-xl text-sm hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="button" onclick="document.getElementById('edit-form').submit()" class="flex-1 bg-[#0d6efd] text-white font-bold py-3 rounded-xl text-sm hover:bg-[#0b5ed7] shadow-[0_4px_14px_0_rgba(13,110,253,0.39)] transition-all inline-flex justify-center items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/></svg>
                        Simpan
                    </button>
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

            document.getElementById('edit-title').textContent = data.title;
            document.getElementById('edit-location').textContent = data.address || '-';
            document.getElementById('edit-reporter').textContent = data.reporter_name;
            document.getElementById('edit-whatsapp').textContent = data.whatsapp || '-';
            document.getElementById('edit-email').textContent = data.reporter_email || '-';
            document.getElementById('edit-time').textContent = data.created_at;
            document.getElementById('edit-ticket').textContent = data.ticket_code;
            document.getElementById('edit-description').textContent = data.description;

            // Pre-select current status
            const radios = document.querySelectorAll('#edit-status-buttons input[name="status"]');
            radios.forEach(r => { r.checked = r.value === data.status; });
            updateStatusUI();

            // Clear form fields
            document.getElementById('edit-message').value = '';
            document.getElementById('photo_upload').value = '';
            document.getElementById('file-name-text').textContent = 'Unggah foto bukti';

            loading.classList.add('hidden');
            body.classList.remove('hidden');
        });
}

function closeEditModal() {
    document.getElementById('admin-edit-modal').classList.add('hidden');
    document.body.style.overflow = '';
}

function updateStatusUI() {
    // Force a minor UI tick if needed, handled by peer classes in Tailwind
}

function updateFileName(input) {
    const textSpan = document.getElementById('file-name-text');
    if (input.files && input.files[0]) {
        textSpan.textContent = input.files[0].name;
    } else {
        textSpan.textContent = 'Unggah foto bukti';
    }
}
</script>
