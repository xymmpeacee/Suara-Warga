<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — SuaraWarga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen flex items-center justify-center px-4">

<div class="w-full max-w-md">
    {{-- Logo --}}
    <div class="text-center mb-8">
        <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-primary/20">
            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38a.75.75 0 0 1-1.021-.27 18.634 18.634 0 0 1-2.434-6.404m5.59-6.404c-.253-.962-.584-1.892-.985-2.783-.247-.55-.06-1.21.463-1.511l.657-.38a.75.75 0 0 1 1.021.27 18.634 18.634 0 0 1 2.434 6.404m-5.59 6.404a18.27 18.27 0 0 0 5.59 0"/></svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">SuaraWarga</h1>
        <p class="text-xs text-gray-400 uppercase tracking-[0.2em] mt-1">Panel Admin</p>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-lg font-bold text-gray-900 mb-1">Masuk ke Dashboard</h2>
        <p class="text-sm text-gray-500 mb-6">Gunakan akun admin Anda untuk melanjutkan.</p>

        @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-3 mb-5">
            <p class="text-red-600 text-sm">{{ $errors->first() }}</p>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4"
                    placeholder="admin@suarawarga.id">
            </div>
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm py-3 px-4"
                    placeholder="••••••••">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                <label for="remember" class="text-sm text-gray-500">Ingat saya</label>
            </div>
            <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-xl text-sm shadow-lg shadow-primary/20 hover:bg-primary-600 transition-colors">
                Masuk
            </button>
        </form>
    </div>

    <p class="text-center text-xs text-gray-400 mt-6">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">← Kembali ke Beranda</a>
    </p>
</div>

</body>
</html>
