<!-- Navbar -->
<nav id="navbar" class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm shadow-xl border-b border-gray-100 overflow-visible">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-2.5 flex-shrink-0">
                <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shadow-md shadow-primary/20">
                    <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 0 0 1.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06ZM18.584 5.106a.75.75 0 0 1 1.06 0c3.808 3.807 3.808 9.98 0 13.788a.75.75 0 0 1-1.06-1.06 8.25 8.25 0 0 0 0-11.668.75.75 0 0 1 0-1.06Z" />
                        <path d="M15.932 7.757a.75.75 0 0 1 1.061 0 6 6 0 0 1 0 8.486.75.75 0 0 1-1.06-1.061 4.5 4.5 0 0 0 0-6.364.75.75 0 0 1 0-1.06Z" />
                    </svg>
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
                    <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Dropdown style) -->
    <!-- Mobile Menu (Dropdown style) -->
    <div id="mobile-menu" class="mobile-menu hidden md:hidden bg-white border-t border-gray-100 shadow-lg">
        <div class="flex flex-col px-4 py-3">
            <a href="{{ route('home') }}"
                class="{{ Route::currentRouteName() === 'home' ? 'bg-primary/5 text-primary font-semibold' : 'text-gray-600' }} 
                  flex items-center px-4 py-3 text-sm rounded-xl transition-all duration-200 hover:bg-primary/5 hover:text-primary hover:translate-x-1">
                <svg class="w-4 h-4 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Beranda
            </a>
            <a href="{{ route('buat-aduan') }}"
                class="{{ Route::currentRouteName() === 'buat-aduan' ? 'bg-primary/5 text-primary font-semibold' : 'text-gray-600' }} 
                  flex items-center px-4 py-3 text-sm rounded-xl transition-all duration-200 hover:bg-primary/5 hover:text-primary hover:translate-x-1">
                <svg class="w-4 h-4 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Buat Aduan
            </a>
            <a href="{{ route('lacak-status') }}"
                class="{{ Route::currentRouteName() === 'lacak-status' ? 'bg-primary/5 text-primary font-semibold' : 'text-gray-600' }} 
                  flex items-center px-4 py-3 text-sm rounded-xl transition-all duration-200 hover:bg-primary/5 hover:text-primary hover:translate-x-1">
                <svg class="w-4 h-4 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>
                Lacak Status
            </a>
        </div>
        <div class="flex items-center gap-2 px-8 py-3 border-t border-gray-100">
            <span class="relative flex h-2.5 w-2.5">
                <span class="absolute inline-flex h-full w-full rounded-full bg-green-500 opacity-75 pulse-ring"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
            </span>
            <span class="text-xs font-medium text-green-600">Sistem aktif</span>
        </div>
    </div>
</nav>