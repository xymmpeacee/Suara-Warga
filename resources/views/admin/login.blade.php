<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — SuaraWarga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-[#f8f9fa] overflow-hidden">

<div class="h-screen w-full flex flex-col lg:flex-row">
    {{-- Left Panel (Form) --}}
    <div class="w-full lg:w-[45%] xl:w-[40%] flex flex-col p-8 lg:px-14 lg:py-8 relative bg-[#f8f9fa] h-screen justify-between">
        
        {{-- Logo --}}
        <div class="shrink-0 mb-6">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="w-10 h-10 bg-[#0d6efd] rounded-full flex items-center justify-center shadow-md shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38a.75.75 0 0 1-1.021-.27 18.634 18.634 0 0 1-2.434-6.404m5.59-6.404c-.253-.962-.584-1.892-.985-2.783-.247-.55-.06-1.21.463-1.511l.657-.38a.75.75 0 0 1 1.021.27 18.634 18.634 0 0 1 2.434 6.404m-5.59 6.404a18.27 18.27 0 0 0 5.59 0"/></svg>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-xl font-bold text-gray-900 tracking-tight">SuaraWarga</span>
                    <span class="text-[10px] font-semibold text-gray-500 tracking-widest uppercase mt-0.5">Layanan Aduan</span>
                </div>
            </a>
        </div>

        {{-- Form Area --}}
        <div class="w-full max-w-sm mx-auto my-auto">
            <h1 class="text-2xl font-bold text-[#1f2937] mb-2">Selamat Datang Kembali</h1>
            <p class="text-sm text-gray-500 mb-6 leading-relaxed">Silakan masuk ke akun administratif Anda untuk mengelola sistem.</p>

            @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-3 mb-5">
                <p class="text-red-600 text-sm">{{ $errors->first() }}</p>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0d6efd]/20 focus:border-[#0d6efd] transition-all shadow-sm placeholder:text-gray-400"
                            placeholder="nama@email.com">
                    </div>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input type="password" name="password" id="password" required
                            class="w-full pl-11 pr-11 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#0d6efd]/20 focus:border-[#0d6efd] transition-all shadow-sm placeholder:text-gray-400 tracking-widest"
                            placeholder="••••••••">
                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-2 hidden">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-[#0d6efd] focus:ring-[#0d6efd]" checked>
                </div>

                <button type="submit" class="w-full mt-4 bg-[#0d6efd] hover:bg-[#0b5ed7] text-white font-bold py-3 rounded-xl text-sm shadow-[0_4px_14px_0_rgba(13,110,253,0.39)] transition-all">
                    Masuk sebagai Admin
                </button>
            </form>
        </div>

        {{-- Footer --}}
        <div class="shrink-0 mt-6 pt-4 border-t border-gray-200 text-center sm:text-left">
            <p class="text-[11px] text-gray-400">&copy; 2026 SuaraWarga. Untuk warga, oleh warga.</p>
        </div>
    </div>

    {{-- Right Panel (Illustration) --}}
    <div class="hidden lg:flex lg:w-[55%] xl:w-[60%] bg-[#0d6efd] flex-col p-8 relative overflow-hidden justify-center items-center h-screen">
        {{-- Background pattern --}}
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px]"></div>
        
        <div class="relative z-10 w-full max-w-xl flex flex-col gap-6 xl:gap-8">
            {{-- Text Area --}}
            <div>
                <h2 class="text-3xl xl:text-4xl font-extrabold text-white leading-tight mb-3">
                    Kelola pengaduan warga dengan lebih efisien dan transparan.
                </h2>
                <p class="text-blue-100 text-sm xl:text-base leading-relaxed">
                    Gunakan platform administrasi terpusat untuk memantau, memverifikasi, dan menindaklanjuti setiap aspirasi warga secara real-time.
                </p>
            </div>

            {{-- Realistic Mockup (Compact) --}}
            <div class="border border-white/20 bg-white/10 backdrop-blur-md rounded-2xl shadow-2xl p-5">
                {{-- Header --}}
                <div class="flex items-center gap-3 mb-4 pb-3 border-b border-white/10">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center text-white shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/></svg>
                    </div>
                    <div>
                        <div class="text-white font-bold text-sm leading-tight">Dashboard Overview</div>
                        <div class="text-blue-200 text-[9px] uppercase tracking-wider font-semibold mt-0.5">Real-time statistics</div>
                    </div>
                </div>
                
                {{-- Stats Cards --}}
                <div class="grid grid-cols-3 gap-3 mb-4">
                    <div class="bg-white/10 rounded-xl p-3 border border-white/5 relative overflow-hidden">
                        <p class="text-blue-100 text-[9px] uppercase font-bold tracking-widest mb-1 opacity-80">Total Aduan</p>
                        <p class="text-white text-xl xl:text-2xl font-extrabold">2.410</p>
                    </div>
                    <div class="bg-white/10 rounded-xl p-3 border border-white/5 relative overflow-hidden">
                        <p class="text-yellow-300 text-[9px] uppercase font-bold tracking-widest mb-1 opacity-90">Diproses</p>
                        <p class="text-white text-xl xl:text-2xl font-extrabold">124</p>
                    </div>
                    <div class="bg-white/10 rounded-xl p-3 border border-white/5 relative overflow-hidden">
                        <p class="text-green-300 text-[9px] uppercase font-bold tracking-widest mb-1 opacity-90">Selesai</p>
                        <p class="text-white text-xl xl:text-2xl font-extrabold">2.286</p>
                    </div>
                </div>

                {{-- List --}}
                <div class="bg-white/10 rounded-xl p-3 space-y-2 border border-white/5">
                    <div class="text-white font-semibold text-[11px] xl:text-xs mb-2">Aduan Masuk Terkini</div>
                    
                    <div class="w-full bg-white/5 rounded flex items-center p-2.5 gap-3">
                        <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full shrink-0"></div>
                        <div class="flex-1">
                            <div class="text-white text-[11px] xl:text-xs font-semibold mb-0.5">Jalan berlubang parah di Jl. Sudirman</div>
                            <div class="text-blue-200 text-[9px] xl:text-[10px] opacity-70">in Infrastruktur • 10 menit lalu</div>
                        </div>
                    </div>
                    <div class="w-full bg-white/5 rounded flex items-center p-2.5 gap-3">
                        <div class="w-1.5 h-1.5 bg-green-400 rounded-full shrink-0"></div>
                        <div class="flex-1">
                            <div class="text-white text-[11px] xl:text-xs font-semibold mb-0.5">Lampu penerangan mati total</div>
                            <div class="text-blue-200 text-[9px] xl:text-[10px] opacity-70">in Fasilitas Umum • 45 menit lalu</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
