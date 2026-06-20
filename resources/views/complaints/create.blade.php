<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buat Aduan — SuaraWarga</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">

@include('partials.landing.navbar')

<main class="max-w-3xl mx-auto px-4 sm:px-6 py-10 sm:py-16">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('home') }}" class="text-sm text-primary font-medium hover:underline inline-flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
            Kembali
        </a>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Buat Aduan Baru</h1>
        <p class="text-gray-500 mt-1">Laporkan masalah di lingkungan Anda secara transparan dan akuntabel.</p>
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

    <form action="{{ route('buat-aduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

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

        {{-- 2. Judul --}}
        <div>
            <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Aduan <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" maxlength="150"
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4"
                placeholder="Contoh: Lubang besar di Jl. Melati">
            <p class="text-xs text-gray-400 mt-1"><span id="title-count">{{ strlen(old('title', '')) }}</span>/150 karakter</p>
        </div>

        {{-- 3. Deskripsi --}}
        <div>
            <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="description" id="description" rows="4" minlength="20"
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4"
                placeholder="Jelaskan masalah secara detail (min. 20 karakter)...">{{ old('description') }}</textarea>
        </div>

        {{-- 4. Lokasi (Map Picker) --}}
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Lokasi <span class="text-red-500">*</span></label>
            <div id="map" class="w-full h-64 sm:h-80 rounded-xl border border-gray-300 shadow-sm z-0"></div>
            <div class="flex flex-wrap items-center gap-3 mt-3">
                <button type="button" id="btn-locate" class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary text-white text-sm font-medium rounded-full hover:bg-primary-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                    Lokasi saya
                </button>
                <span id="location-status" class="text-xs text-gray-400"></span>
            </div>
            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
            <input type="text" name="address" id="address" value="{{ old('address') }}" readonly
                class="w-full mt-3 rounded-xl border-gray-200 bg-gray-50 shadow-sm text-sm py-3 px-4 text-gray-500"
                placeholder="Alamat akan terisi otomatis setelah memilih lokasi di peta">
        </div>

        {{-- 5. Foto Bukti --}}
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Foto Bukti <span class="text-red-500">*</span></label>
            <div id="photo-dropzone" class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary transition-colors cursor-pointer">
                <input type="file" name="photo" id="photo" accept="image/jpeg,image/png" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <div id="photo-placeholder">
                    <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                    <p class="text-sm text-gray-500">Klik atau seret foto ke sini</p>
                    <p class="text-xs text-gray-400 mt-1">JPG / PNG, maks. 5MB</p>
                </div>
                <img id="photo-preview" class="hidden max-h-48 mx-auto rounded-lg" alt="Preview">
            </div>
        </div>

        {{-- 6. Prioritas --}}
        <div>
            <label for="priority" class="block text-sm font-bold text-gray-700 mb-2">Tingkat Prioritas <span class="text-red-500">*</span></label>
            <select name="priority" id="priority" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4">
                <option value="">Pilih prioritas</option>
                @foreach(\App\Models\Complaint::PRIORITY_LABELS as $val => $label)
                <option value="{{ $val }}" {{ old('priority') === $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        {{-- 7. WhatsApp --}}
        <div>
            <label for="whatsapp" class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp <span class="text-red-500">*</span></label>
            <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}"
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4"
                placeholder="Contoh: 081234567890">
        </div>

        {{-- 8. Email --}}
        <div>
            <label for="reporter_email" class="block text-sm font-bold text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
            <input type="email" name="reporter_email" id="reporter_email" value="{{ old('reporter_email') }}"
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4"
                placeholder="Email untuk menerima kode tiket & notifikasi update">
        </div>

        {{-- 9. Nama Pelapor --}}
        <div>
            <label for="reporter_name" class="block text-sm font-bold text-gray-700 mb-2">Nama Pelapor <span class="text-gray-400 font-normal">(opsional)</span></label>
            <input type="text" name="reporter_name" id="reporter_name" value="{{ old('reporter_name') }}"
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4"
                placeholder="Kosongkan jika ingin anonim">
        </div>

        {{-- 10. Pernyataan --}}
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
    </form>
</main>

@include('partials.landing.footer')

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // ===== Map Picker (Leaflet + OpenStreetMap) =====
    const defaultLat = {{ old('latitude', -6.9175) }};
    const defaultLng = {{ old('longitude', 107.6191) }};

    const map = L.map('map').setView([defaultLat, defaultLng], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors', maxZoom: 19
    }).addTo(map);

    let marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

    function updateLocation(lat, lng) {
        document.getElementById('latitude').value = lat.toFixed(7);
        document.getElementById('longitude').value = lng.toFixed(7);
        marker.setLatLng([lat, lng]);
        map.setView([lat, lng], map.getZoom());

        // Reverse geocode via Nominatim
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
            .then(r => r.json())
            .then(data => {
                if (data.display_name) {
                    document.getElementById('address').value = data.display_name;
                }
            }).catch(() => {});
    }

    // Klik peta
    map.on('click', e => updateLocation(e.latlng.lat, e.latlng.lng));
    // Drag marker
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

    // Set initial location if old values exist
    @if(old('latitude') && old('longitude'))
        updateLocation({{ old('latitude') }}, {{ old('longitude') }});
    @endif

    // ===== Photo Preview =====
    document.getElementById('photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const preview = document.getElementById('photo-preview');
            const placeholder = document.getElementById('photo-placeholder');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
    });

    // ===== Title Character Counter =====
    document.getElementById('title').addEventListener('input', function() {
        document.getElementById('title-count').textContent = this.value.length;
    });

    // ===== Mobile Menu (reuse from landing) =====
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
