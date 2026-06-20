<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin — SuaraWarga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .card-top-border { position: relative; }
        .card-top-border::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; border-top-left-radius: 1rem; border-top-right-radius: 1rem;
        }
        .border-pending::before { background-color: #f97316; } /* orange-500 */
        .border-diproses::before { background-color: #3b82f6; } /* blue-500 */
        .border-selesai::before { background-color: #22c55e; } /* green-500 */
        
        .pill-status { display: inline-flex; items-center; gap: 6px; padding: 4px 12px; border-radius: 9999px; font-size: 11px; font-weight: 600; }
        .pill-pending { background-color: #ffedd5; color: #ea580c; border: 1px solid #fed7aa; }
        .pill-pending::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background-color: #ea580c; }
        .pill-diproses { background-color: #dbeafe; color: #2563eb; border: 1px solid #bfdbfe; }
        .pill-diproses::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background-color: #2563eb; }
        .pill-selesai { background-color: #dcfce7; color: #16a34a; border: 1px solid #bbf7d0; }
        .pill-selesai::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background-color: #16a34a; }
        .pill-ditolak { background-color: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }
        .pill-ditolak::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background-color: #dc2626; }
        
        .pill-priority { display: inline-flex; items-center; gap: 6px; padding: 4px 12px; border-radius: 9999px; font-size: 11px; font-weight: 600; background-color: #f3f4f6; color: #4b5563; border: 1px solid #e5e7eb; }
        .pill-priority::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background-color: #6b7280; }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-[#f4f5f7]">

{{-- Admin Navbar --}}
<nav class="sticky top-0 z-50 bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                <div class="w-8 h-8 bg-[#0d6efd] rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38a.75.75 0 0 1-1.021-.27 18.634 18.634 0 0 1-2.434-6.404m5.59-6.404c-.253-.962-.584-1.892-.985-2.783-.247-.55-.06-1.21.463-1.511l.657-.38a.75.75 0 0 1 1.021.27 18.634 18.634 0 0 1 2.434 6.404m-5.59 6.404a18.27 18.27 0 0 0 5.59 0"/></svg>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-lg font-bold text-gray-900 tracking-tight">SuaraWarga</span>
                    <span class="text-[9px] font-semibold text-gray-500 tracking-[0.2em] uppercase mt-0.5">Panel Petugas</span>
                </div>
            </a>
            
            <div class="hidden md:flex items-center gap-2 lg:gap-6">
                <a href="{{ route('admin.dashboard') }}" class="px-5 py-2 bg-[#0052cc] text-white text-sm font-semibold rounded-full shadow-md">Dashboard</a>
                <a href="{{ route('buat-aduan') }}" target="_blank" class="px-4 py-2 text-gray-500 hover:text-gray-900 text-sm font-medium transition-colors">Buat Aduan</a>
                <a href="{{ route('lacak-status') }}" target="_blank" class="px-4 py-2 text-gray-500 hover:text-gray-900 text-sm font-medium transition-colors">Lacak Status</a>
            </div>

            <div class="flex items-center gap-4">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium px-4 py-2 rounded-full transition-colors inline-flex items-center gap-2 border border-gray-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/></svg>
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
        <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
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
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 relative">
            <p class="text-xs text-gray-600 uppercase tracking-widest font-bold mb-2">Total Laporan</p>
            <p class="text-4xl font-extrabold text-gray-900">{{ $stats['total'] }}</p>
            <div class="absolute bottom-6 right-6 opacity-30">
                <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 card-top-border border-pending relative">
            <p class="text-xs text-gray-600 uppercase tracking-widest font-bold mb-2">Pending</p>
            <p class="text-4xl font-extrabold text-gray-900">{{ $stats['pending'] }}</p>
            <div class="absolute bottom-6 right-6 opacity-30">
                <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"/></svg>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 card-top-border border-diproses relative">
            <p class="text-xs text-gray-600 uppercase tracking-widest font-bold mb-2">Diproses</p>
            <p class="text-4xl font-extrabold text-gray-900">{{ $stats['diproses'] }}</p>
            <div class="absolute bottom-6 right-6 opacity-30">
                <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"/></svg>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 card-top-border border-selesai relative">
            <p class="text-xs text-gray-600 uppercase tracking-widest font-bold mb-2">Selesai</p>
            <p class="text-4xl font-extrabold text-gray-900">{{ $stats['selesai'] }}</p>
            <div class="absolute bottom-6 right-6 opacity-30">
                <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"/></svg>
            </div>
        </div>
    </div>

    {{-- Search, Filters, Sort --}}
    <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-col sm:flex-row gap-4 mb-6">
        <div class="flex-1 relative">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari jalan, sampah, atau lainnya..."
                class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-full shadow-sm focus:border-primary focus:ring-primary text-sm transition-colors">
        </div>
        <select name="category" onchange="this.form.submit()" class="bg-white border border-gray-200 rounded-full shadow-sm text-sm py-3 px-5 font-medium text-gray-600 focus:border-primary focus:ring-primary cursor-pointer min-w-[160px]">
            <option value="">Semua Kategori</option>
            @foreach(\App\Models\Complaint::CATEGORY_LABELS as $val => $label)
            <option value="{{ $val }}" {{ request('category') === $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <select name="status" onchange="this.form.submit()" class="bg-white border border-gray-200 rounded-full shadow-sm text-sm py-3 px-5 font-medium text-gray-600 focus:border-primary focus:ring-primary cursor-pointer min-w-[160px]">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
    </form>

    {{-- Table --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#f8f9fa] border-b border-gray-200">
                    <tr>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Aduan</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest hidden md:table-cell">Lokasi</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest hidden lg:table-cell">Prioritas</th>
                        <th class="text-center px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Status</th>
                        <th class="text-center px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($complaints as $c)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-5">
                            <p class="font-bold text-gray-900 mb-1 line-clamp-1">{{ $c->title }}</p>
                            <p class="text-[10px] text-gray-400 font-medium">
                                {{ $c->ticket_code }} &bull; {{ $c->category_label }}
                            </p>
                        </td>
                        <td class="px-6 py-5 hidden md:table-cell">
                            <div class="flex items-center gap-1.5 text-xs text-gray-600 font-medium line-clamp-1 max-w-[220px]">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                                {{ $c->address ?? '-' }}
                            </div>
                        </td>
                        <td class="px-6 py-5 hidden lg:table-cell">
                            <span class="pill-priority">{{ ucfirst($c->priority) }}</span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            @php
                                $pillClass = match($c->status) {
                                    'pending' => 'pill-pending',
                                    'diproses' => 'pill-diproses',
                                    'selesai' => 'pill-selesai',
                                    'ditolak' => 'pill-ditolak',
                                    default => ''
                                };
                            @endphp
                            <span class="pill-status {{ $pillClass }}">{{ $c->status_label }}</span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <button onclick="openEditModal({{ $c->id }})" class="w-8 h-8 rounded-full bg-[#0052cc] text-white flex items-center justify-center hover:bg-[#003d99] shadow-sm transition-colors mx-auto">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                            </button>
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
        
        {{-- Custom Pagination Bar (Matches Image) --}}
        @if($complaints->hasPages())
        <div class="bg-[#f8f9fa] border-t border-gray-200 px-6 py-4 flex items-center justify-between">
            <span class="text-xs text-gray-500 font-medium">Menampilkan <strong>{{ $complaints->firstItem() }}-{{ $complaints->lastItem() }}</strong> dari <strong>{{ $complaints->total() }}</strong> entri</span>
            <div>
                {{ $complaints->links('pagination::tailwind') }}
            </div>
        </div>
        @endif
    </div>
</main>

{{-- Edit Modal --}}
@include('admin.partials._edit-modal')

</body>
</html>
