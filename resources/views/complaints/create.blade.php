<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buat Aduan — SuaraWarga</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">

@include('partials.landing.navbar')

<main class="max-w-5xl mx-auto px-4 sm:px-6 py-10 sm:py-16">
{{-- Header (di luar card) --}}
<div class="mb-4">
    <span class="inline-block text-xs font-bold tracking-[0.2em] uppercase text-primary mb-2">Formulir Aduan</span>
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Apa yang ingin kamu laporkan?</h1>
    <p class="text-gray-500 mt-1">Isi detail di bawah. Semakin lengkap, semakin cepat ditangani.</p>
</div>

{{-- Validation Errors --}}
@if ($errors->any())
<div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
    <p class="text-red-700 font-semibold text-sm mb-2">Terdapat kesalahan pada pengisian form:</p>
    <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
    </ul>
</div>
@endif

{{-- Form Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 sm:p-6">
    <form action="{{ route('buat-aduan.store') }}" method="POST" enctype="multipart/form-data" id="complaint-form">
        @csrf

        <div class="space-y-8">
            {{-- 1. Kategori (Chip Selector) --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-3">Kategori Aduan <span class="text-red-500">*</span></label>
                <div class="flex flex-wrap gap-2" id="category-chips">
                    @foreach(\App\Models\Complaint::CATEGORY_LABELS as $value => $label)
                    <label class="cursor-pointer">
                        <input type="radio" name="category" value="{{ $value }}" class="hidden peer" {{ old('category') === $value ? 'checked' : '' }}>
                        <span class="peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary inline-block px-4 py-2 rounded-full text-sm font-medium border border-gray-300 text-gray-600 hover:border-primary hover:text-primary transition-colors">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- 2. Judul + Prioritas (2 kolom) --}}
            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Aduan <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" maxlength="150"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4"
                        placeholder="Contoh: Lubang besar di Jl. Melati">
                    <p class="text-xs text-gray-400 mt-1"><span id="title-count">{{ strlen(old('title', '')) }}</span>/150 karakter</p>
                </div>

                <div>
                    <label for="priority" class="block text-sm font-bold text-gray-700 mb-2">Tingkat Prioritas <span class="text-red-500">*</span></label>
                    <select name="priority" id="priority" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4">
                        <option value="">Pilih prioritas</option>
                        @foreach(\App\Models\Complaint::PRIORITY_LABELS as $val => $label)
                        <option value="{{ $val }}" {{ old('priority') === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- 3. Deskripsi --}}
            <div>
                <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="4" minlength="20"
                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4"
                    placeholder="Jelaskan masalah secara detail (min. 20 karakter)...">{{ old('description') }}</textarea>
            </div>

            {{-- 4. Lokasi (Map Picker + Address Search) --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Lokasi <span class="text-red-500">*</span></label>
                <div id="map" class="w-full h-72 sm:h-96 rounded-xl border border-gray-300 shadow-sm z-0"></div>
                <div class="flex flex-wrap items-center gap-3 mt-3">
                    <button type="button" id="btn-locate" class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary text-white text-sm font-medium rounded-full hover:bg-primary-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                        Lokasi saya
                    </button>
                    <span id="location-status" class="text-xs text-gray-400"></span>
                </div>
                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

                <div class="relative mt-3">
                    <input type="text" name="address" id="address" value="{{ old('address') }}" autocomplete="off"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4"
                        placeholder="Ketik alamat, contoh: Jl. Melati No. 10, Bandung">
                    <div id="address-suggestions" class="hidden absolute z-50 mt-1.5 w-full bg-white border border-gray-200 rounded-xl shadow-lg max-h-60 overflow-y-auto"></div>
                </div>
                <p class="text-xs text-gray-400 mt-1.5">Ketik alamat untuk mencari otomatis, atau klik/geser pin di peta untuk memilih lokasi secara manual.</p>
            </div>

            {{-- 5. Foto Bukti (dengan Cropper) --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Foto Bukti <span class="text-red-500">*</span></label>
                <p class="text-xs text-gray-400 mb-3">Disarankan foto dengan orientasi <strong>landscape (16:9)</strong> agar tampil pas di kartu aduan.</p>

                {{-- Dropzone (sebelum foto dipilih) --}}
                <div id="photo-dropzone" class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary transition-colors cursor-pointer">
                    <input type="file" name="photo_raw" id="photo_raw" accept="image/jpeg,image/png" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                    <p class="text-sm text-gray-500">Klik atau seret foto ke sini</p>
                    <p class="text-xs text-gray-400 mt-1">JPG / PNG, maks. 5MB</p>
                </div>

                {{-- Hasil crop (setelah foto dipilih) --}}
                <div id="photo-result" class="hidden">
                    <div class="relative rounded-xl overflow-hidden border border-gray-200 aspect-video bg-gray-100">
                        <img id="photo-preview" class="w-full h-full object-cover" alt="Preview hasil crop">
                    </div>
                    <div class="flex items-center justify-between mt-3">
                        <p class="text-xs text-gray-400">Beginilah tampilan foto di kartu aduan.</p>
                        <div class="flex gap-2">
                            <button type="button" id="btn-edit-photo" class="text-xs font-semibold text-primary hover:underline">Edit Foto</button>
                            <span class="text-gray-300">•</span>
                            <button type="button" id="btn-remove-photo" class="text-xs font-semibold text-red-500 hover:underline">Hapus</button>
                        </div>
                    </div>
                </div>

                {{-- Hidden input yang dikirim ke server (hasil crop, sudah 16:9) --}}
                <input type="file" name="photo" id="photo" class="hidden">
            </div>

            {{-- 6. WhatsApp + Email (2 kolom) --}}
            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label for="whatsapp" class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp <span class="text-red-500">*</span></label>
                    <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4"
                        placeholder="Contoh: 081234567890">
                </div>

                <div>
                    <label for="reporter_email" class="block text-sm font-bold text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="reporter_email" id="reporter_email" value="{{ old('reporter_email') }}"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4"
                        placeholder="Email untuk menerima kode tiket & notifikasi update">
                </div>
            </div>

            {{-- 7. Nama Pelapor --}}
            <div>
                <label for="reporter_name" class="block text-sm font-bold text-gray-700 mb-2">Nama Pelapor <span class="text-gray-400 font-normal">(opsional)</span></label>
                <input type="text" name="reporter_name" id="reporter_name" value="{{ old('reporter_name') }}"
                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4"
                    placeholder="Kosongkan jika ingin anonim">
            </div>

            {{-- 8. Pernyataan --}}
            <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 rounded-xl p-4">
                <input type="checkbox" name="agreement" id="agreement" value="1"
                    class="mt-0.5 rounded border-gray-300 text-primary focus:ring-primary" {{ old('agreement') ? 'checked' : '' }}>
                <label for="agreement" class="text-sm text-gray-600 leading-relaxed">
                    Saya menyatakan bahwa informasi yang saya berikan adalah benar dan dapat dipertanggungjawabkan. <span class="text-red-500">*</span>
                </label>
            </div>

            {{-- Submit --}}
            <button type="submit" class="w-full btn-primary-cta bg-primary text-white font-bold py-3.5 rounded-xl text-sm shadow-lg shadow-primary/20 hover:bg-primary-600 transition-colors">
                Kirim Aduan
            </button>
        </div>
    </form>
    </div>
</main>

@include('partials.landing.footer')

{{-- ===== Crop Modal ===== --}}
<div id="crop-modal" class="hidden fixed inset-0 bg-black/60 z-[60] flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-900">Sesuaikan Foto</h3>
            <button type="button" id="crop-close" class="p-1.5 rounded-lg hover:bg-gray-100">
                <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-5">
            <div class="max-h-96 overflow-hidden rounded-xl bg-gray-900">
                <img id="crop-image" class="max-w-full block" alt="Crop target">
            </div>
            <p class="text-xs text-gray-400 mt-3">Geser dan perbesar/perkecil untuk menyesuaikan area foto (rasio 16:9).</p>
        </div>
        <div class="p-5 border-t border-gray-100 flex gap-3">
            <button type="button" id="crop-cancel" class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-600 font-medium rounded-xl text-sm hover:bg-gray-50">
                Batal
            </button>
            <button type="button" id="crop-confirm" class="flex-1 px-4 py-2.5 bg-primary text-white font-semibold rounded-xl text-sm hover:bg-primary-600">
                Gunakan Foto Ini
            </button>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script>
        // ===== Map Picker (Leaflet + OpenStreetMap) =====
        const defaultLat = {{ old('latitude', -6.9175) }};
        const defaultLng = {{ old('longitude', 107.6191) }};

        const map = L.map('map').setView([defaultLat, defaultLng], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors', maxZoom: 19
        }).addTo(map);

        let marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

        const addressInput   = document.getElementById('address');
        const suggestionsBox = document.getElementById('address-suggestions');
        let isProgrammaticUpdate = false;
        let searchTimeout = null;

        // doReverseGeocode = false saat dipanggil dari search box (alamat sudah ada teksnya)
        function updateLocation(lat, lng, doReverseGeocode = true) {
            document.getElementById('latitude').value = lat.toFixed(7);
            document.getElementById('longitude').value = lng.toFixed(7);
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], map.getZoom());

            if (doReverseGeocode) {
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
                    .then(r => r.json())
                    .then(data => {
                        if (data.display_name) {
                            isProgrammaticUpdate = true;
                            addressInput.value = data.display_name;
                            isProgrammaticUpdate = false;
                        }
                    }).catch(() => {});
            }
        }

        // Klik peta → isi alamat otomatis
        map.on('click', e => updateLocation(e.latlng.lat, e.latlng.lng));
        // Drag marker → isi alamat otomatis
        marker.on('dragend', e => {
            const pos = e.target.getLatLng();
            updateLocation(pos.lat, pos.lng);
        });

        // Tombol Lokasi Saya (geolocation)
        document.getElementById('btn-locate').addEventListener('click', () => {
            const status = document.getElementById('location-status');
            if (!navigator.geolocation) {
                status.textContent = 'Browser tidak mendukung geolocation.';
                return;
            }
            status.textContent = 'Mencari lokasi...';
            navigator.geolocation.getCurrentPosition(
                pos => {
                    updateLocation(pos.coords.latitude, pos.coords.longitude);
                    map.setZoom(17);
                    status.textContent = 'Lokasi ditemukan!';
                    setTimeout(() => status.textContent = '', 3000);
                },
                () => { status.textContent = 'Gagal mendapatkan lokasi.'; }
            );
        });

        // ===== Address Search (Manual Input → Map ikut) =====
        function hideSuggestions() {
            suggestionsBox.classList.add('hidden');
            suggestionsBox.innerHTML = '';
        }

        function showSuggestions(results) {
            if (!results.length) { hideSuggestions(); return; }

            suggestionsBox.innerHTML = results.map((r, i) => `
                <button type="button" data-index="${i}" class="suggestion-item w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 border-b border-gray-100 last:border-0 flex items-start gap-2">
                    <svg class="w-4 h-4 text-gray-400 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                    <span>${r.display_name}</span>
                </button>
            `).join('');
            suggestionsBox.classList.remove('hidden');

            suggestionsBox.querySelectorAll('.suggestion-item').forEach((btn, i) => {
                btn.addEventListener('click', () => {
                    const r = results[i];
                    isProgrammaticUpdate = true;
                    addressInput.value = r.display_name;
                    updateLocation(parseFloat(r.lat), parseFloat(r.lon), false);
                    map.setZoom(17);
                    hideSuggestions();
                    isProgrammaticUpdate = false;
                });
            });
        }

        addressInput.addEventListener('input', () => {
            if (isProgrammaticUpdate) return;
            clearTimeout(searchTimeout);

            const query = addressInput.value.trim();
            if (query.length < 3) { hideSuggestions(); return; }

            searchTimeout = setTimeout(() => {
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=5&countrycodes=id&addressdetails=1`)
                    .then(r => r.json())
                    .then(results => showSuggestions(results))
                    .catch(() => hideSuggestions());
            }, 500);
        });

        // Sembunyikan dropdown saat klik di luar
        document.addEventListener('click', (e) => {
            if (!addressInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
                hideSuggestions();
            }
        });

        // Set initial location if old values exist
        @if(old('latitude') && old('longitude'))
            updateLocation({{ old('latitude') }}, {{ old('longitude') }}, false);
        @endif

    // ===== Photo Crop Flow =====
    const photoRawInput   = document.getElementById('photo_raw');
    const photoInput      = document.getElementById('photo');
    const dropzone         = document.getElementById('photo-dropzone');
    const photoResult      = document.getElementById('photo-result');
    const photoPreview     = document.getElementById('photo-preview');
    const cropModal        = document.getElementById('crop-modal');
    const cropImage        = document.getElementById('crop-image');
    let cropper = null;
    let lastRawDataUrl = null;

    function openCropModal(dataUrl) {
        lastRawDataUrl = dataUrl;
        cropImage.src = dataUrl;
        cropModal.classList.remove('hidden');

        cropImage.onload = () => {
            if (cropper) cropper.destroy();
            cropper = new Cropper(cropImage, {
                aspectRatio: 16 / 9,
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 1,
                background: false,
                responsive: true,
            });
        };
    }

    function closeCropModal() {
        cropModal.classList.add('hidden');
        if (cropper) { cropper.destroy(); cropper = null; }
    }

    photoRawInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran foto maksimal 5MB.');
            photoRawInput.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = (ev) => openCropModal(ev.target.result);
        reader.readAsDataURL(file);
    });

    document.getElementById('crop-cancel').addEventListener('click', () => {
        closeCropModal();
        photoRawInput.value = '';
    });
    document.getElementById('crop-close').addEventListener('click', () => {
        closeCropModal();
        photoRawInput.value = '';
    });

    document.getElementById('crop-confirm').addEventListener('click', () => {
        if (!cropper) return;

        cropper.getCroppedCanvas({
            width: 1280,
            height: 720,
            imageSmoothingQuality: 'high',
        }).toBlob((blob) => {
            photoPreview.src = URL.createObjectURL(blob);
            dropzone.classList.add('hidden');
            photoResult.classList.remove('hidden');

            const croppedFile = new File([blob], 'foto-aduan.jpg', { type: 'image/jpeg' });
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(croppedFile);
            photoInput.files = dataTransfer.files;

            closeCropModal();
        }, 'image/jpeg', 0.9);
    });

    document.getElementById('btn-edit-photo').addEventListener('click', () => {
        if (lastRawDataUrl) openCropModal(lastRawDataUrl);
    });

    document.getElementById('btn-remove-photo').addEventListener('click', () => {
        photoRawInput.value = '';
        photoInput.value = '';
        lastRawDataUrl = null;
        dropzone.classList.remove('hidden');
        photoResult.classList.add('hidden');
    });

    document.getElementById('complaint-form').addEventListener('submit', (e) => {
        if (!photoInput.files.length) {
            e.preventDefault();
            alert('Mohon unggah dan sesuaikan foto bukti terlebih dahulu.');
            dropzone.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

    // ===== Title Character Counter =====
    document.getElementById('title').addEventListener('input', function() {
        document.getElementById('title-count').textContent = this.value.length;
    });

    // ===== Mobile Menu =====
    const menuBtn = document.getElementById('mobile-menu-btn');
    const menuClose = document.getElementById('mobile-menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuOverlay = document.getElementById('mobile-menu-overlay');
    if (menuBtn) {
        menuBtn.addEventListener('click', () => { mobileMenu.classList.add('open'); menuOverlay.classList.remove('hidden'); document.body.style.overflow = 'hidden'; });
        menuClose.addEventListener('click', () => { mobileMenu.classList.remove('open'); menuOverlay.classList.add('hidden'); document.body.style.overflow = ''; });
        menuOverlay.addEventListener('click', () => { mobileMenu.classList.remove('open'); menuOverlay.classList.add('hidden'); document.body.style.overflow = ''; });
    }
</script>
</body>
</html>