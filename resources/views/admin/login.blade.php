<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Log in') }} - SuaraWarga</title>

    {{-- Sesuaikan path ini jika setup Vite kamu berbeda --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">

    <div class="min-h-screen bg-gray-100 flex flex-col md:flex-row">

        {{-- ============ KIRI: FORM LOGIN ============ --}}
        <div class="w-full md:w-1/2 flex items-center justify-center px-6 sm:px-12 lg:px-20 py-10">
            <div class="w-full max-w-md mx-auto md:mx-0">

                {{-- Logo --}}
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#0d6efd] rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38a.75.75 0 0 1-1.021-.27 18.634 18.634 0 0 1-2.434-6.404m5.59-6.404c-.253-.962-.584-1.892-.985-2.783-.247-.55-.06-1.21.463-1.511l.657-.38a.75.75 0 0 1 1.021.27 18.634 18.634 0 0 1 2.434 6.404m-5.59 6.404a18.27 18.27 0 0 0 5.59 0" />
                        </svg>
                    </div>
                    <div class="leading-tight">
                        <p class="text-lg font-extrabold tracking-tight text-gray-900">SuaraWarga</p>
                        <p class="text-[11px] font-semibold tracking-widest text-gray-500">LAYANAN ADUAN</p>
                    </div>
                </div>

                {{-- Heading + form, jarak lebih lega dari logo --}}
                <div class="mt-16 w-full">

                    <h1 class="text-3xl font-extrabold text-gray-900">Selamat Datang Kembali</h1>
                    <p class="mt-2 text-sm text-gray-500">
                        Silakan masuk ke akun administratif Anda untuk mengelola sistem.
                    </p>

                    <x-auth-session-status class="mt-4" :status="session('status')" />

                    <form method="POST" action="{{ route('admin.login') }}" class="mt-8 space-y-5">
                        @csrf

                        {{-- Email --}}
                        <div>
                            <label for="email" class="mb-1.5 block text-sm font-semibold text-gray-700">Email</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0-.83.67-1.5 1.5-1.5h16.5c.83 0 1.5.67 1.5 1.5v10.5c0 .83-.67 1.5-1.5 1.5H3.75a1.5 1.5 0 0 1-1.5-1.5V6.75Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m3 7 9 6 9-6" />
                                    </svg>
                                </span>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                    autocomplete="username" placeholder="nama@email.com"
                                    class="w-full rounded-xl border border-gray-200 bg-white py-3.5 pl-12 pr-4 text-base text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- Password --}}
                        <div x-data="{ show: false }">
                            <label for="password" class="mb-1.5 block text-sm font-semibold text-gray-700">Password</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V7.5a4.5 4.5 0 1 0-9 0v3" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5h15v8.25a1.5 1.5 0 0 1-1.5 1.5h-12a1.5 1.5 0 0 1-1.5-1.5V10.5Z" />
                                    </svg>
                                </span>
                                <input :type="show ? 'text' : 'password'" id="password" name="password" required
                                    autocomplete="current-password" placeholder="••••••••"
                                    class="w-full rounded-xl border border-gray-200 bg-white py-3.5 pl-12 pr-12 text-base text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" />
                                <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-gray-600">
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14.25a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Z" />
                                    </svg>
                                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c1.07 0 2.1-.16 3.07-.456M6.228 6.228A10.45 10.45 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.243 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        {{-- Remember me + lupa password --}}
                        <div class="flex items-center justify-between pt-1">
                            <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-gray-600">
                                <input id="remember_me" type="checkbox" name="remember"
                                    class="rounded border-gray-300 text-blue-700 shadow-sm focus:ring-blue-600">
                                {{ __('Ingat saya') }}
                            </label>

                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm font-medium text-blue-700 hover:text-blue-800 hover:underline">
                                {{ __('Lupa password?') }}
                            </a>
                            @endif
                        </div>

                        <button type="submit"
                            class="w-full rounded-xl bg-blue-700 py-3.5 text-base font-semibold text-white shadow-sm shadow-blue-700/30 transition hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600/40 focus:ring-offset-2">
                            Masuk sebagai Admin
                        </button>
                    </form>
                </div>

                {{-- Footer --}}
                <div class="mt-6 w-full">
                    <hr class="border-gray-200">
                    <p class="pt-6 text-center text-xs text-gray-400">
                        &copy; {{ now()->year }} SuaraWarga
                        <span class="mx-2 text-gray-300">&middot;</span>
                        <a href="{{ route('home') }}" class="font-medium text-gray-400 hover:text-primary">
                            Kembali ke Beranda &rarr;
                        </a>
                    </p>
                </div>
            </div>
        </div>

        {{-- ============ KANAN: PANEL BRANDING ============ --}}
        <div class="hidden md:flex md:w-1/2 p-4 lg:p-6">
            <div class="relative flex w-full flex-col justify-center overflow-hidden rounded-3xl bg-blue-700 px-12 py-16 text-white lg:px-16">

                <h2 class="text-3xl font-extrabold leading-tight lg:text-4xl">
                    Kelola pengaduan warga dengan lebih efisien dan transparan.
                </h2>
                <p class="mt-5 max-w-md text-blue-100">
                    Gunakan platform administrasi terpusat untuk memantau, memverifikasi, dan menindaklanjuti setiap aspirasi warga secara real-time.
                </p>

                {{-- Mockup dashboard (dekoratif) --}}
                <div class="mt-12 rounded-2xl bg-white/10 p-5">
                    <div class="flex gap-4">
                        {{-- sidebar --}}
                        <div class="flex flex-col gap-3">
                            <div class="h-9 w-9 rounded-lg bg-white/25"></div>
                            <div class="h-9 w-9 rounded-lg bg-white/15"></div>
                            <div class="h-9 w-9 rounded-lg bg-white/15"></div>
                            <div class="h-9 w-9 rounded-lg bg-white/15"></div>
                        </div>

                        <div class="flex-1 space-y-4">
                            {{-- stat cards --}}
                            <div class="grid grid-cols-3 gap-3">
                                <div class="rounded-xl bg-white/15 p-3">
                                    <div class="h-6 w-6 rounded-full bg-white/40"></div>
                                    <div class="mt-3 h-2 w-full rounded-full bg-white/30"></div>
                                </div>
                                <div class="rounded-xl bg-white/15 p-3">
                                    <div class="h-6 w-6 rounded-full bg-gray-300/70"></div>
                                    <div class="mt-3 h-2 w-full rounded-full bg-white/30"></div>
                                </div>
                                <div class="rounded-xl bg-white/15 p-3">
                                    <div class="h-6 w-6 rounded-full bg-teal-300/70"></div>
                                    <div class="mt-3 h-2 w-full rounded-full bg-white/30"></div>
                                </div>
                            </div>

                            {{-- list --}}
                            <div class="space-y-3 rounded-xl bg-white/10 p-4">
                                <div class="flex items-center justify-between">
                                    <div class="h-2.5 w-2/5 rounded-full bg-white/40"></div>
                                    <div class="h-2.5 w-8 rounded-full bg-white/25"></div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="h-5 w-5 shrink-0 rounded-full bg-white/30"></div>
                                    <div class="h-2.5 w-full rounded-full bg-white/20"></div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="h-5 w-5 shrink-0 rounded-full bg-white/30"></div>
                                    <div class="h-2.5 w-full rounded-full bg-white/20"></div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="h-5 w-5 shrink-0 rounded-full bg-white/30"></div>
                                    <div class="h-2.5 w-full rounded-full bg-white/20"></div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="h-5 w-5 shrink-0 rounded-full bg-white/30"></div>
                                    <div class="h-2.5 w-full rounded-full bg-white/20"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>