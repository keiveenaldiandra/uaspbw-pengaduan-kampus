<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengaduan Kampus</title>
    <meta name="description" content="Platform pengaduan kampus yang mudah, cepat, dan transparan untuk mahasiswa.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #1e3a5f 0%, #1e40af 50%, #1d4ed8 100%); }
        .glass { background: rgba(255,255,255,0.08); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.15); }
        .feature-card:hover { transform: translateY(-4px); }
        .feature-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    </style>
</head>
<body class="bg-white antialiased">

    {{-- NAVBAR --}}
    <nav class="gradient-bg sticky top-0 z-50 shadow-lg">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                </div>
                <span class="text-white font-bold text-lg">Pengaduan Kampus</span>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-white/20 hover:bg-white/30 text-white font-medium px-4 py-2 rounded-xl transition-colors text-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-white/80 hover:text-white font-medium px-4 py-2 rounded-xl transition-colors text-sm">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-white text-blue-700 hover:bg-blue-50 font-semibold px-5 py-2 rounded-xl transition-colors text-sm shadow-sm">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="gradient-bg text-white pt-20 pb-32 px-6 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-white/5 rounded-full"></div>
            <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-white/5 rounded-full"></div>
        </div>
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <span class="inline-block bg-white/10 border border-white/20 text-blue-200 text-xs font-semibold px-4 py-1.5 rounded-full mb-6 uppercase tracking-wider">Platform Pengaduan Resmi</span>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                Suarakan Masalahmu,<br>
                <span class="text-blue-200">Kami Tindaklanjuti</span>
            </h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto mb-10 leading-relaxed">
                Sistem pengaduan kampus yang transparan dan mudah digunakan. Laporkan masalah di lingkungan kampus dan pantau penanganannya secara real-time.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-white text-blue-700 hover:bg-blue-50 font-bold px-8 py-4 rounded-2xl transition-all shadow-lg hover:shadow-xl text-lg">
                        Buka Dashboard →
                    </a>
                @else
                    <a href="{{ route('register') }}" class="bg-white text-blue-700 hover:bg-blue-50 font-bold px-8 py-4 rounded-2xl transition-all shadow-lg hover:shadow-xl text-lg">
                        Mulai Sekarang →
                    </a>
                    <a href="{{ route('login') }}" class="glass text-white hover:bg-white/20 font-semibold px-8 py-4 rounded-2xl transition-all text-lg">
                        Sudah Punya Akun
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- STATS --}}
    <section class="bg-slate-50 py-16 px-6">
        <div class="max-w-4xl mx-auto grid grid-cols-3 gap-8 text-center">
            <div>
                <p class="text-4xl font-extrabold text-blue-700 mb-1">100%</p>
                <p class="text-slate-500 text-sm">Transparan</p>
            </div>
            <div>
                <p class="text-4xl font-extrabold text-blue-700 mb-1">24/7</p>
                <p class="text-slate-500 text-sm">Bisa Diakses</p>
            </div>
            <div>
                <p class="text-4xl font-extrabold text-blue-700 mb-1">Real-time</p>
                <p class="text-slate-500 text-sm">Update Status</p>
            </div>
        </div>
    </section>

    {{-- CARA KERJA --}}
    <section class="bg-slate-50 py-20 px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-14">
                <h2 class="text-3xl font-extrabold text-slate-800 mb-3">Cara Kerjanya Sederhana</h2>
            </div>
            <div class="flex flex-col md:flex-row gap-8 items-center justify-center">
                @foreach([
                    ['1', 'Daftar Akun', 'Buat akun mahasiswa dengan email kampusmu'],
                    ['2', 'Isi Pengaduan', 'Pilih kategori, tulis detail masalah, dan sertakan foto'],
                    ['3', 'Pantau Status', 'Lacak perkembangan pengaduanmu hingga selesai'],
                ] as [$num, $title, $desc])
                <div class="flex-1 text-center">
                    <div class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-xl font-extrabold mx-auto mb-4 shadow-lg">{{ $num }}</div>
                    <h3 class="font-bold text-slate-800 mb-1">{{ $title }}</h3>
                    <p class="text-slate-500 text-sm">{{ $desc }}</p>
                </div>
                @if(!$loop->last)
                    <div class="hidden md:block text-slate-300 text-3xl">→</div>
                @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="gradient-bg py-20 px-6 text-center text-white">
        <h2 class="text-3xl font-extrabold mb-4">Siap Menyampaikan Pengaduan?</h2>
        <p class="text-blue-200 mb-8 max-w-xl mx-auto">Bergabunglah dan bantu kami menciptakan lingkungan kampus yang lebih baik bersama-sama.</p>
        @auth
            <a href="{{ url('/dashboard') }}" class="bg-white text-blue-700 hover:bg-blue-50 font-bold px-8 py-4 rounded-2xl transition-all shadow-lg text-lg">Buka Dashboard →</a>
        @else
            <a href="{{ route('register') }}" class="bg-white text-blue-700 hover:bg-blue-50 font-bold px-8 py-4 rounded-2xl transition-all shadow-lg text-lg">Daftar Gratis Sekarang →</a>
        @endauth
    </section>

    {{-- FOOTER --}}
    <footer class="bg-slate-900 text-slate-400 text-center py-6 text-sm">
        &copy; {{ date('Y') }} Sistem Pengaduan Kampus
    </footer>

</body>
</html>
