<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin — SuaraWarga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">

{{-- Admin Navbar --}}
<nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shadow-md shadow-primary/20">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38a.75.75 0 0 1-1.021-.27 18.634 18.634 0 0 1-2.434-6.404m5.59-6.404c-.253-.962-.584-1.892-.985-2.783-.247-.55-.06-1.21.463-1.511l.657-.38a.75.75 0 0 1 1.021.27 18.634 18.634 0 0 1 2.434 6.404m-5.59 6.404a18.27 18.27 0 0 0 5.59 0"/></svg>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-base font-bold text-gray-900 tracking-tight">SuaraWarga</span>
                    <span class="text-[10px] font-semibold text-gray-400 tracking-[0.15em] uppercase">Admin Panel</span>
                </div>
            </a>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500 hidden sm:inline">{{ Auth::guard('admin')->user()->name }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 font-medium hover:text-red-700 transition-colors inline-flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Success Flash --}}
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-center gap-3">
        <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
        <p class="text-green-700 text-sm font-medium">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola seluruh aduan warga dari satu tempat.</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
            <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-1">Total Laporan</p>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
            <p class="text-xs text-yellow-600 uppercase tracking-wider font-semibold mb-1">Pending</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
            <p class="text-xs text-blue-600 uppercase tracking-wider font-semibold mb-1">Diproses</p>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['diproses'] }}</p>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
            <p class="text-xs text-green-600 uppercase tracking-wider font-semibold mb-1">Selesai</p>
            <p class="text-3xl font-bold text-green-600">{{ $stats['selesai'] }}</p>
        </div>
    </div>

    {{-- Search, Filters, Sort --}}
    <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-col sm:flex-row gap-3 mb-6">
        <div class="flex-1 relative">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tiket, judul, lokasi, nama..."
                class="w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
        </div>
        <select name="category" class="rounded-xl border-gray-300 shadow-sm text-sm py-2.5 px-3">
            <option value="">Kategori</option>
            @foreach(\App\Models\Complaint::CATEGORY_LABELS as $val => $label)
            <option value="{{ $val }}" {{ request('category') === $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <select name="status" class="rounded-xl border-gray-300 shadow-sm text-sm py-2.5 px-3">
            <option value="">Status</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
        <select name="sort" class="rounded-xl border-gray-300 shadow-sm text-sm py-2.5 px-3">
            <option value="terbaru" {{ $sort === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
            <option value="upvote" {{ $sort === 'upvote' ? 'selected' : '' }}>Upvote Terbanyak</option>
        </select>
        <button type="submit" class="bg-primary text-white font-semibold px-5 py-2.5 rounded-xl text-sm hover:bg-primary-600 transition-colors">
            Filter
        </button>
    </form>

    {{-- Table --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aduan</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">Lokasi</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden lg:table-cell">Prioritas</th>
                        <th class="text-center px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Dukungan</th>
                        <th class="text-center px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="text-center px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($complaints as $c)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-5 py-4">
                            <p class="font-semibold text-gray-900 line-clamp-1">{{ $c->title }}</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-[10px] font-mono text-gray-400">{{ $c->ticket_code }}</span>
                                <span class="{{ $c->category_color }} text-[10px] font-semibold px-2 py-0.5 rounded-full">{{ $c->category_label }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-gray-500 text-xs hidden md:table-cell line-clamp-1 max-w-[200px]">{{ $c->address ?? '-' }}</td>
                        <td class="px-5 py-4 hidden lg:table-cell">
                            @php
                                $prColors = ['rendah' => 'text-green-600', 'sedang' => 'text-yellow-600', 'tinggi' => 'text-red-600'];
                            @endphp
                            <span class="text-xs font-semibold {{ $prColors[$c->priority] ?? 'text-gray-500' }}">{{ ucfirst($c->priority) }}</span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-flex items-center gap-1 text-sm font-semibold text-gray-700">👍 {{ $c->upvote_count }}</span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <span class="{{ $c->status_color }} text-xs font-semibold px-2.5 py-1 rounded-full">{{ $c->status_label }}</span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <button onclick="openEditModal({{ $c->id }})"
                                class="text-primary hover:text-primary-700 font-medium text-xs inline-flex items-center gap-1 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/></svg>
                                Edit
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-12 text-gray-400">Tidak ada data aduan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">{{ $complaints->links() }}</div>
</main>

{{-- Edit Modal --}}
@include('admin.partials._edit-modal')

</body>
</html>
