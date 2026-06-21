<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-bold text-slate-800">Dashboard Admin</h1>
    </x-slot>

    {{-- Greeting --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Selamat datang, {{ auth()->user()->name }}! 👋</h2>
        <p class="text-slate-500 mt-1">Ringkasan sistem pengaduan kampus hari ini.</p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total</p>
                <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-slate-800">{{ $totalPengaduan }}</p>
            <p class="text-xs text-slate-400 mt-1">Pengaduan masuk</p>
        </div>
        <div class="bg-amber-50 rounded-2xl shadow-sm border border-amber-100 p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-semibold text-amber-500 uppercase tracking-wider">Menunggu</p>
                <div class="w-9 h-9 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-amber-600">{{ $menunggu }}</p>
            <p class="text-xs text-amber-400 mt-1">Perlu ditindaklanjuti</p>
        </div>
        <div class="bg-blue-50 rounded-2xl shadow-sm border border-blue-100 p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-semibold text-blue-500 uppercase tracking-wider">Diproses</p>
                <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-blue-600">{{ $diproses }}</p>
            <p class="text-xs text-blue-400 mt-1">Sedang ditangani</p>
        </div>
        <div class="bg-green-50 rounded-2xl shadow-sm border border-green-100 p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-semibold text-green-500 uppercase tracking-wider">Selesai</p>
                <div class="w-9 h-9 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-green-600">{{ $selesai }}</p>
            <p class="text-xs text-green-400 mt-1">Terselesaikan</p>
        </div>
    </div>

    {{-- Info Row --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-purple-50 rounded-2xl border border-purple-100 p-5 flex items-center gap-4">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-purple-700">{{ $totalMahasiswa }}</p>
                <p class="text-xs text-purple-400">Total Mahasiswa</p>
            </div>
        </div>
        <div class="bg-indigo-50 rounded-2xl border border-indigo-100 p-5 flex items-center gap-4">
            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-indigo-700">{{ $totalKategori }}</p>
                <p class="text-xs text-indigo-400">Kategori Aktif</p>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">
        {{-- Pengaduan Terbaru --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-semibold text-slate-800">Pengaduan Terbaru</h3>
                <a href="{{ route('admin.pengaduan.index') }}" class="text-blue-600 text-sm hover:underline">Lihat semua →</a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($pengaduanTerbaru as $p)
                    @php
                        $badge = match($p->status) {
                            'Menunggu' => 'bg-amber-100 text-amber-700',
                            'Diproses' => 'bg-blue-100 text-blue-700',
                            'Selesai'  => 'bg-green-100 text-green-700',
                            'Ditolak'  => 'bg-red-100 text-red-700',
                            default    => 'bg-slate-100 text-slate-600',
                        };
                    @endphp
                    <a href="{{ route('admin.pengaduan.show', $p->id) }}" class="flex items-center gap-3 px-6 py-3.5 hover:bg-slate-50 transition-colors">
                        <div class="w-9 h-9 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-blue-600 text-sm font-bold">{{ substr($p->user->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-slate-800 text-sm truncate">{{ $p->judul }}</p>
                            <p class="text-xs text-slate-400">{{ $p->user->name }} · {{ $p->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $badge }} flex-shrink-0">{{ $p->status }}</span>
                    </a>
                @empty
                    <div class="text-center py-10 text-slate-400 text-sm">Belum ada pengaduan</div>
                @endforelse
            </div>
        </div>

        {{-- Per Kategori --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-slate-800">Pengaduan per Kategori</h3>
            </div>
            <div class="p-6 space-y-4">
                @forelse($perKategori as $k)
                    @php $pct = $totalPengaduan > 0 ? round(($k->pengaduans_count / $totalPengaduan) * 100) : 0; @endphp
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-slate-700">{{ $k->nama_kategori }}</span>
                            <span class="text-slate-400">{{ $k->pengaduans_count }} ({{ $pct }}%)</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full transition-all duration-500" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-400 text-sm text-center py-4">Belum ada kategori</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
