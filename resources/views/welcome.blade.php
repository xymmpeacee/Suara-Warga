<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SuaraWarga — Platform aduan warga untuk melaporkan masalah lingkungan seperti jalan rusak, sampah menumpuk, dan lampu padam. Transparan, cepat, dan dapat dipertanggungjawabkan.">
    <title>SuaraWarga — Layanan Aduan Warga</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">

    @include('partials.landing.navbar')
    @include('partials.landing.hero')
    @include('partials.landing.cara-kerja')
    @include('partials.landing.aduan-terkini')
    @include('partials.landing.mengapa')
    @include('partials.landing.footer')

    @include('complaints.partials._detail-modal')

    <script>
        // ===== Mobile Menu Toggle =====
        const menuBtn = document.getElementById('mobile-menu-btn');
        const menuClose = document.getElementById('mobile-menu-close');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuOverlay = document.getElementById('mobile-menu-overlay');

        function openMenu() {
            mobileMenu.classList.add('open');
            menuOverlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeMenu() {
            mobileMenu.classList.remove('open');
            menuOverlay.classList.add('hidden');
            document.body.style.overflow = '';
        }

        menuBtn.addEventListener('click', openMenu);
        menuClose.addEventListener('click', closeMenu);
        menuOverlay.addEventListener('click', closeMenu);

        // Close menu on nav link click
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeMenu);
        });

        // ===== Scroll Reveal (Intersection Observer) =====
        const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-stagger');
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

        revealElements.forEach(el => revealObserver.observe(el));

        // ===== Count-up Animation =====
        const countElements = document.querySelectorAll('[data-count]');
        const countObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.dataset.count, 10);
                    let current = 0;
                    const duration = 1200;
                    const step = Math.ceil(duration / target);

                    const timer = setInterval(() => {
                        current++;
                        el.textContent = current;
                        if (current >= target) clearInterval(timer);
                    }, step);

                    countObserver.unobserve(el);
                }
            });
        }, { threshold: 0.5 });

        countElements.forEach(el => countObserver.observe(el));

        // ===== Navbar shadow on scroll =====
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                navbar.classList.add('shadow-md');
                navbar.classList.remove('shadow-sm');
            } else {
                navbar.classList.remove('shadow-md');
                navbar.classList.add('shadow-sm');
            }
        });
    </script>
</body>
</html>
