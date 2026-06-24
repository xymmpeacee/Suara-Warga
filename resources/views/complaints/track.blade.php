<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lacak Status Aduan — SuaraWarga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900" style="background-color: #F0F2F5;">
    @include('partials.landing.navbar')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
        {{-- Header --}}
        <div class="mb-8">
            <span class="inline-block text-xs font-bold tracking-[0.2em] uppercase text-primary mb-2">Lacak Status</span>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Pantau Status Aduan Warga</h1>
            <p class="text-gray-500 mt-1">Cari berdasarkan kode tiket, judul, atau lokasi.</p>
        </div>

        {{-- Search & Filters --}}
        <form method="GET" action="{{ route('lacak-status') }}" class="flex flex-col sm:flex-row gap-3 mb-8">
            <div class="flex-1 relative">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm"
                    placeholder="Cari kode tiket, judul, atau lokasi...">
            </div>
            {{-- Dropdown Kategori --}}
            <div x-data="{
                open: false,
                selected: '{{ request('category') }}',
                label: '{{ request('category') ? \App\Models\Complaint::CATEGORY_LABELS[request('category')] ?? 'Semua Kategori' : 'Semua Kategori' }}',
                options: [
                    { value: '', label: 'Semua Kategori' },
                    @foreach(\App\Models\Complaint::CATEGORY_LABELS as $val => $label)
                    { value: '{{ $val }}', label: '{{ $label }}' },
                    @endforeach
                ],
                select(opt) { this.selected = opt.value; this.label = opt.label; this.open = false; }
            }" class="relative">
                <input type="hidden" name="category" :value="selected">
                <button type="button" @click="open = !open" @click.outside="open = false"
                    class="flex items-center justify-between gap-3 w-full sm:w-44 rounded-xl border border-gray-300 bg-white shadow-sm text-sm py-3 pl-4 pr-3 text-gray-700 hover:border-primary/50 transition-colors">
                    <span x-text="label"></span>
                    <svg class="w-4 h-4 text-gray-400 shrink-0 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute z-20 mt-1.5 w-full bg-white rounded-xl shadow-lg border border-gray-100 py-1.5 overflow-hidden">
                    <template x-for="opt in options" :key="opt.value">
                        <button type="button" @click="select(opt)"
                            class="w-full text-left px-4 py-2 text-sm hover:bg-primary/5 hover:text-primary transition-colors"
                            :class="selected === opt.value ? 'text-primary font-semibold bg-primary/5' : 'text-gray-700'"
                            x-text="opt.label"></button>
                    </template>
                </div>
            </div>

            {{-- Dropdown Status --}}
            <div x-data="{
                open: false,
                selected: '{{ request('status') }}',
                label: '{{ request('status') ? ucfirst(request('status')) : 'Semua Status' }}',
                options: [
                    { value: '', label: 'Semua Status' },
                    { value: 'pending', label: 'Pending' },
                    { value: 'diproses', label: 'Diproses' },
                    { value: 'selesai', label: 'Selesai' },
                ],
                select(opt) { this.selected = opt.value; this.label = opt.label; this.open = false; }
            }" class="relative">
                <input type="hidden" name="status" :value="selected">
                <button type="button" @click="open = !open" @click.outside="open = false"
                    class="flex items-center justify-between gap-3 w-full sm:w-40 rounded-xl border border-gray-300 bg-white shadow-sm text-sm py-3 pl-4 pr-3 text-gray-700 hover:border-primary/50 transition-colors">
                    <span x-text="label"></span>
                    <svg class="w-4 h-4 text-gray-400 shrink-0 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute z-20 mt-1.5 w-full bg-white rounded-xl shadow-lg border border-gray-100 py-1.5 overflow-hidden">
                    <template x-for="opt in options" :key="opt.value">
                        <button type="button" @click="select(opt)"
                            class="w-full text-left px-4 py-2 text-sm hover:bg-primary/5 hover:text-primary transition-colors"
                            :class="selected === opt.value ? 'text-primary font-semibold bg-primary/5' : 'text-gray-700'"
                            x-text="opt.label"></button>
                    </template>
                </div>
            </div>
            <button type="submit" class="bg-primary text-white font-semibold px-6 py-3 rounded-xl text-sm hover:bg-primary-600 transition-colors">
                Cari
            </button>
        </form>

        {{-- Results --}}
        @if($complaints->isEmpty())
        <div class="text-center py-16">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <p class="text-gray-500 text-lg font-medium">Tidak ada aduan ditemukan</p>
            <p class="text-gray-400 text-sm mt-1">Coba ubah kata kunci atau filter pencarian Anda.</p>
        </div>
        @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($complaints as $complaint)
            @include('complaints.partials._card', ['complaint' => $complaint])
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($complaints->hasPages())
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4 bg-white rounded-xl border border-gray-200 shadow-sm px-4 sm:px-6 py-4">
            <span class="text-xs text-gray-500 font-medium text-center sm:text-left">
                Menampilkan <strong>{{ $complaints->firstItem() }}–{{ $complaints->lastItem() }}</strong> dari <strong>{{ $complaints->total() }}</strong> aduan
            </span>
            <div class="flex items-center gap-1">
                {{-- Prev --}}
                @if($complaints->onFirstPage())
                <span class="px-3 py-1.5 rounded-lg text-xs font-medium text-gray-300 cursor-not-allowed border border-gray-200">← Sebelumnya</span>
                @else
                <a href="{{ $complaints->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg text-xs font-medium text-gray-600 hover:bg-gray-100 border border-gray-200 transition-colors">← Sebelumnya</a>
                @endif

                {{-- Page numbers --}}
                @foreach($complaints->getUrlRange(1, $complaints->lastPage()) as $page => $url)
                @if($page == $complaints->currentPage())
                <span class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-bold bg-primary text-white border border-primary">{{ $page }}</span>
                @elseif($page == 1 || $page == $complaints->lastPage() || abs($page - $complaints->currentPage()) <= 1)
                    <a href="{{ $url }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-medium text-gray-600 hover:bg-gray-100 border border-gray-200 transition-colors">{{ $page }}</a>
                    @elseif(abs($page - $complaints->currentPage()) == 2)
                    <span class="w-8 h-8 flex items-center justify-center text-xs text-gray-400 border border-gray-200 rounded-lg">...</span>
                    @endif
                    @endforeach

                    {{-- Next --}}
                    @if($complaints->hasMorePages())
                    <a href="{{ $complaints->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg text-xs font-medium text-gray-600 hover:bg-gray-100 border border-gray-200 transition-colors">Selanjutnya →</a>
                    @else
                    <span class="px-3 py-1.5 rounded-lg text-xs font-medium text-gray-300 cursor-not-allowed border border-gray-200">Selanjutnya →</span>
                    @endif
            </div>
        </div>
        @endif
        @endif
    </main>

    @include('partials.landing.footer')

    {{-- Detail Modal --}}
    @include('complaints.partials._detail-modal')

    <script>
        // Mobile menu
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', function() {
            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-8px)';
                mobileMenu.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
                requestAnimationFrame(() => {
                    mobileMenu.style.opacity = '1';
                    mobileMenu.style.transform = 'translateY(0)';
                });
            } else {
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-8px)';
                setTimeout(() => mobileMenu.classList.add('hidden'), 200);
            }
        });

        document.addEventListener('click', function(e) {
            if (!mobileMenu.contains(e.target) && !menuBtn.contains(e.target)) {
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-8px)';
                setTimeout(() => mobileMenu.classList.add('hidden'), 200);
            }
        });

        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-8px)';
                setTimeout(() => mobileMenu.classList.add('hidden'), 200);
            });
        });
    </script>
</body>

</html>