<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aduan Berhasil Dikirim — SuaraWarga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">

@include('partials.landing.navbar')

<main class="max-w-lg mx-auto px-4 sm:px-6 py-16 sm:py-24 text-center">
    {{-- Success Icon --}}
    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-fade-in">
        <svg class="w-10 h-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
    </div>

    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Aduan Berhasil Dikirim!</h1>
    <p class="text-gray-500 mb-8">Terima kasih telah melaporkan. Simpan kode tiket di bawah ini untuk memantau status aduan Anda.</p>

    {{-- Ticket Code Box --}}
    <div class="bg-white border-2 border-dashed border-primary rounded-2xl p-6 mb-8 shadow-sm">
        <p class="text-xs text-gray-400 uppercase tracking-widest mb-2">Kode Tiket Anda</p>
        <p class="text-3xl sm:text-4xl font-bold text-primary tracking-widest">{{ $complaint->ticket_code }}</p>
    </div>

    <p class="text-sm text-gray-400 mb-8">
        Kode tiket juga telah dikirim ke email <strong class="text-gray-600">{{ $complaint->reporter_email }}</strong>
    </p>

    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <a href="{{ route('lacak-status', ['search' => $complaint->ticket_code]) }}"
           class="btn-primary-cta bg-primary text-white font-semibold px-6 py-3 rounded-full text-sm shadow-lg shadow-primary/20 inline-flex items-center justify-center gap-2">
            Lacak Status Aduan
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
        </a>
        <a href="{{ route('home') }}"
           class="border border-gray-300 text-gray-600 font-medium px-6 py-3 rounded-full text-sm hover:bg-gray-50 transition-colors inline-flex items-center justify-center">
            Kembali ke Beranda
        </a>
    </div>
</main>

@include('partials.landing.footer')

<script>
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
