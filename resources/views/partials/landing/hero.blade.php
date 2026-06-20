<!-- Hero Section -->
<section id="hero" class="relative bg-primary overflow-hidden">
    <div class="hero-pattern absolute inset-0"></div>
    <!-- Decorative shapes -->
    <div class="absolute top-20 right-10 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-48 h-48 bg-accent/10 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-20 sm:pt-24 sm:pb-28">
        <!-- Badge -->
        <div class="mb-6 animate-fade-in">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-medium border border-white/25 text-white/80 bg-white/10 backdrop-blur-sm">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                Platform Aduan Resmi Warga
            </span>
        </div>

        <!-- Heading -->
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight mb-6" style="animation: fadeInUp 0.6s ease-out 0.1s both;">
            <span class="text-white">Suara Warga,</span><br>
            <span class="text-accent italic">Aksi Nyata</span>
        </h1>

        <!-- Description -->
        <p class="text-white/80 text-base sm:text-lg max-w-md mb-8 leading-relaxed" style="animation: fadeInUp 0.6s ease-out 0.25s both;">
            Laporkan jalan rusak, sampah menumpuk, lampu padam, dan masalah lingkungan lainnya. Pantau setiap langkah penanganan secara transparan.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-wrap gap-3 mb-12" style="animation: fadeInUp 0.6s ease-out 0.4s both;">
            <a href="{{ route('buat-aduan') }}" class="btn-primary-cta inline-flex items-center gap-2 bg-accent text-gray-900 font-semibold px-7 py-3 rounded-full text-sm shadow-lg shadow-accent/30">
                Buat Aduan
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            </a>
            <a href="{{ route('lacak-status') }}" class="btn-secondary-cta inline-flex items-center gap-2 border border-white/40 text-white font-medium px-7 py-3 rounded-full text-sm backdrop-blur-sm">
                Lacak Status
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-3 max-w-md" style="animation: fadeInUp 0.6s ease-out 0.55s both;">
            <div class="bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl px-4 py-4 text-center">
                <div class="text-2xl sm:text-3xl font-bold text-white" data-count="{{ $stats['total'] }}">0</div>
                <div class="text-xs text-white/60 mt-1">Total Aduan</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl px-4 py-4 text-center">
                <div class="text-2xl sm:text-3xl font-bold text-white" data-count="{{ $stats['diproses'] }}">0</div>
                <div class="text-xs text-white/60 mt-1">Diproses</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl px-4 py-4 text-center">
                <div class="text-2xl sm:text-3xl font-bold text-white" data-count="{{ $stats['selesai'] }}">0</div>
                <div class="text-xs text-white/60 mt-1">Selesai</div>
            </div>
        </div>
    </div>
</section>
