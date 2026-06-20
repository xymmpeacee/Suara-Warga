<!-- Navbar -->
<nav id="navbar" class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-2.5 flex-shrink-0">
                <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shadow-md shadow-primary/20">
                    <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38a.75.75 0 0 1-1.021-.27 18.634 18.634 0 0 1-2.434-6.404m5.59-6.404c-.253-.962-.584-1.892-.985-2.783-.247-.55-.06-1.21.463-1.511l.657-.38a.75.75 0 0 1 1.021.27 18.634 18.634 0 0 1 2.434 6.404m-5.59 6.404a18.27 18.27 0 0 0 5.59 0"/></svg>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-base font-bold text-gray-900 tracking-tight">SuaraWarga</span>
                    <span class="text-[10px] font-semibold text-gray-400 tracking-[0.15em] uppercase">Layanan Aduan</span>
                </div>
            </a>

            <!-- Nav Links (Desktop) -->
            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('home') }}" class="{{ Route::currentRouteName() === 'home' ? 'nav-link-active' : 'nav-link' }}">Beranda</a>
                <a href="{{ route('buat-aduan') }}" class="{{ Route::currentRouteName() === 'buat-aduan' ? 'nav-link-active' : 'nav-link' }}">Buat Aduan</a>
                <a href="{{ route('lacak-status') }}" class="{{ Route::currentRouteName() === 'lacak-status' ? 'nav-link-active' : 'nav-link' }}">Lacak Status</a>
            </div>

            <!-- Status + Mobile Toggle -->
            <div class="flex items-center gap-4">
                <div class="hidden sm:flex items-center gap-2">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="absolute inline-flex h-full w-full rounded-full bg-green-500 opacity-75 pulse-ring"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                    </span>
                    <span class="text-xs font-medium text-green-600">Sistem aktif</span>
                </div>
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors" aria-label="Menu">
                    <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu fixed inset-y-0 right-0 w-72 bg-white shadow-2xl z-50 p-6 flex flex-col gap-6 md:hidden">
        <div class="flex justify-between items-center">
            <span class="font-bold text-gray-900">Menu</span>
            <button id="mobile-menu-close" class="p-2 rounded-lg hover:bg-gray-100">
                <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="flex flex-col gap-2">
            <a href="{{ route('home') }}" class="{{ Route::currentRouteName() === 'home' ? 'nav-link-active text-center py-2.5' : 'nav-link text-center py-2.5' }}">Beranda</a>
            <a href="{{ route('buat-aduan') }}" class="{{ Route::currentRouteName() === 'buat-aduan' ? 'nav-link-active text-center py-2.5' : 'nav-link text-center py-2.5' }}">Buat Aduan</a>
            <a href="{{ route('lacak-status') }}" class="{{ Route::currentRouteName() === 'lacak-status' ? 'nav-link-active text-center py-2.5' : 'nav-link text-center py-2.5' }}">Lacak Status</a>
        </div>
        <div class="flex items-center gap-2 mt-auto">
            <span class="relative flex h-2.5 w-2.5"><span class="absolute inline-flex h-full w-full rounded-full bg-green-500 opacity-75 pulse-ring"></span><span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span></span>
            <span class="text-xs font-medium text-green-600">Sistem aktif</span>
        </div>
    </div>
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40 hidden md:hidden"></div>
</nav>
