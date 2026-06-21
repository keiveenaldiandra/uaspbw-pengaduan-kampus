<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistem Pengaduan Kampus') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex">
        {{-- Left Panel --}}
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700 relative overflow-hidden flex-col items-center justify-center p-12 text-white">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
            <div class="relative z-10 text-center max-w-sm">
                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                </div>
                <h1 class="text-3xl font-extrabold mb-3">Sistem Pengaduan Kampus</h1>
                <p class="text-blue-200 leading-relaxed">Platform resmi untuk menyampaikan pengaduan dan aspirasi mahasiswa kampus.</p>
                <div class="mt-10 grid grid-cols-3 gap-4 text-center">
                    <div class="bg-white/10 rounded-xl p-3">
                        <p class="text-2xl font-bold">100%</p>
                        <p class="text-xs text-blue-300 mt-1">Transparan</p>
                    </div>
                    <div class="bg-white/10 rounded-xl p-3">
                        <p class="text-2xl font-bold">24/7</p>
                        <p class="text-xs text-blue-300 mt-1">Online</p>
                    </div>
                    <div class="bg-white/10 rounded-xl p-3">
                        <p class="text-2xl font-bold">Cepat</p>
                        <p class="text-xs text-blue-300 mt-1">Respons</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Panel --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-slate-50">
            <div class="w-full max-w-md">
                <div class="lg:hidden text-center mb-8">
                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    </div>
                    <h2 class="font-bold text-slate-800 text-lg">Pengaduan Kampus</h2>
                </div>
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
                    {{ $slot }}
                </div>
                <p class="text-center text-slate-400 text-xs mt-6">
                    &copy; {{ date('Y') }} Sistem Pengaduan Kampus
                </p>
            </div>
        </div>
    </div>
</body>
</html>
