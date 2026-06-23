<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin — SuaraWarga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .card-top-border {
            position: relative;
        }

        .card-top-border::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 4px;
            border-top-left-radius: 1rem;
            border-bottom-left-radius: 1rem;
        }

        .border-pending::before {
            background-color: #f97316;
        }

        .border-diproses::before {
            background-color: #3b82f6;
        }

        .border-selesai::before {
            background-color: #22c55e;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 600;
            border: 1px solid;
        }

        .badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* Status badges */
        .badge-pending {
            background: #fff7ed;
            color: #c2410c;
            border-color: #fed7aa;
        }

        .badge-pending::before {
            background: #f97316;
        }

        .badge-diproses {
            background: #eff6ff;
            color: #1d4ed8;
            border-color: #bfdbfe;
        }

        .badge-diproses::before {
            background: #3b82f6;
        }

        .badge-selesai {
            background: #f0fdf4;
            color: #15803d;
            border-color: #bbf7d0;
        }

        .badge-selesai::before {
            background: #22c55e;
        }

        .badge-ditolak {
            background: #fef2f2;
            color: #b91c1c;
            border-color: #fecaca;
        }

        .badge-ditolak::before {
            background: #ef4444;
        }

        /* Priority badges */
        .badge-tinggi {
            background: #fef2f2;
            color: #b91c1c;
            border-color: #fecaca;
        }

        .badge-tinggi::before {
            background: #ef4444;
        }

        .badge-sedang {
            background: #fefce8;
            color: #a16207;
            border-color: #fde68a;
        }

        .badge-sedang::before {
            background: #eab308;
        }

        .badge-rendah {
            background: #f3f4f6;
            color: #4b5563;
            border-color: #e5e7eb;
        }

        .badge-rendah::before {
            background: #9ca3af;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900 bg-[#f4f5f7]">

    {{-- Admin Navbar --}}
    <nav class="sticky top-0 z-50 bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shadow-md shadow-primary/20">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 0 0 1.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06ZM18.584 5.106a.75.75 0 0 1 1.06 0c3.808 3.807 3.808 9.98 0 13.788a.75.75 0 0 1-1.06-1.06 8.25 8.25 0 0 0 0-11.668.75.75 0 0 1 0-1.06Z" />
                            <path d="M15.932 7.757a.75.75 0 0 1 1.061 0 6 6 0 0 1 0 8.486.75.75 0 0 1-1.06-1.061 4.5 4.5 0 0 0 0-6.364.75.75 0 0 1 0-1.06Z" />
                        </svg>
                    </div>
                    <div class="flex flex-col leading-none">
                        <span class="text-base font-bold text-gray-900 tracking-tight">SuaraWarga</span>
                        <span class="text-[10px] font-semibold text-gray-400 tracking-[0.15em] uppercase">PANEL PETUGAS</span>
                    </div>
                </a>

                <div class="flex items-center gap-4">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium px-4 py-2 rounded-full transition-colors inline-flex items-center gap-2 border border-gray-200">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{-- Success Flash --}}
        @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <p class="text-green-700 text-sm font-medium">{{ session('success') }}</p>
        </div>
        @endif

        {{-- Header --}}
        <div class="mb-10">
            <p class="text-[11px] font-bold text-[#0052cc] tracking-[0.15em] uppercase mb-1">Panel Petugas</p>
            <h1 class="text-3xl font-extrabold text-gray-900">Dashboard Admin</h1>
            <p class="text-gray-500 text-sm mt-2">Kelola, verifikasi, dan pantau seluruh pengaduan masyarakat secara cepat dan transparan.</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
            <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100 relative">
                <p class="text-xs text-gray-600 uppercase tracking-widest font-bold mb-2">Total Laporan</p>
                <p class="text-4xl font-extrabold text-gray-900">{{ $stats['total'] }}</p>
                <div class="absolute bottom-6 right-6 opacity-30">
                    <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100 card-top-border border-pending relative overflow-hidden">
                <p class="text-xs text-gray-600 uppercase tracking-widest font-bold mb-2">Pending</p>
                <p class="text-4xl font-extrabold text-gray-900">{{ $stats['pending'] }}</p>
                <div class="absolute bottom-6 right-6 opacity-30">
                    <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100 card-top-border border-diproses relative overflow-hidden">
                <p class="text-xs text-gray-600 uppercase tracking-widest font-bold mb-2">Diproses</p>
                <p class="text-4xl font-extrabold text-gray-900">{{ $stats['diproses'] }}</p>
                <div class="absolute bottom-6 right-6 opacity-30">
                    <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100 card-top-border border-selesai relative overflow-hidden">
                <p class="text-xs text-gray-600 uppercase tracking-widest font-bold mb-2">Selesai</p>
                <p class="text-4xl font-extrabold text-gray-900">{{ $stats['selesai'] }}</p>
                <div class="absolute bottom-6 right-6 opacity-30">
                    <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Search, Filters, Sort --}}
        <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-col sm:flex-row gap-4 mb-6">
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

        {{-- Table --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#f8f9fa] border-b border-gray-200">
                        <tr>
                            <th class="text-left px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Aduan</th>
                            <th class="text-left px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest hidden md:table-cell">Lokasi</th>
                            <th class="text-center px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest hidden lg:table-cell">Prioritas</th>
                            <th class="text-center px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Status</th>
                            <th class="text-center px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($complaints as $c)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-900 mb-0.5 line-clamp-1">{{ $c->title }}</p>
                                <p class="text-[11px] text-gray-400 font-medium">
                                    {{ $c->ticket_code }} &bull; {{ $c->category_label }}
                                </p>
                            </td>
                            <td class="px-6 py-4 hidden md:table-cell max-w-[200px]">
                                <div class="flex items-start gap-1.5 text-xs text-gray-500">
                                    <svg class="w-3.5 h-3.5 text-gray-400 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    <span class="line-clamp-2">{{ $c->address ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 hidden lg:table-cell text-center">
                                <span class="badge badge-{{ strtolower($c->priority ?? 'sedang') }}">{{ ucfirst($c->priority ?? 'Sedang') }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="badge badge-{{ $c->status }}">{{ $c->status_label }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="openEditModal({{ $c->id }})" class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center hover:bg-primary-700 shadow-sm transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </button>
                                    <form method="POST" action="{{ route('admin.complaint.destroy', $c->id) }}" onsubmit="return confirm('Yakin ingin menghapus aduan {{ addslashes($c->title) }}? Tindakan ini tidak dapat dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-600 shadow-sm transition-colors">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-400 font-medium">Tidak ada data aduan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($complaints->hasPages())
            <div class="bg-[#f8f9fa] border-t border-gray-200 px-6 py-4 flex items-center justify-between gap-4">
                <span class="text-xs text-gray-500 font-medium shrink-0">
                    Menampilkan <strong>{{ $complaints->firstItem() }}–{{ $complaints->lastItem() }}</strong> dari <strong>{{ $complaints->total() }}</strong> entri
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
        </div>
    </main>

    {{-- Edit Modal --}}
    @include('admin.partials._edit-modal')

</body>

</html>