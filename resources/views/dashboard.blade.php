<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-bold text-slate-800">Dashboard</h1>
    </x-slot>

    @php
        $myPengaduans = auth()->user()->pengaduans()->with('kategori')->latest()->get();
        $total     = $myPengaduans->count();
        $menunggu  = $myPengaduans->where('status', 'Menunggu')->count();
        $diproses  = $myPengaduans->where('status', 'Diproses')->count();
        $selesai   = $myPengaduans->where('status', 'Selesai')->count();
        $ditolak   = $myPengaduans->where('status', 'Ditolak')->count();
    @endphp

    {{-- Greeting --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Halo, {{ auth()->user()->name }}! 👋</h2>
        <p class="text-slate-500 mt-1">Berikut ringkasan pengaduan yang kamu kirimkan.</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
            <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Total</p>
            <p class="text-3xl font-bold text-slate-800 mt-1">{{ $total }}</p>
            <p class="text-xs text-slate-400 mt-1">pengaduan</p>
        </div>
        <div class="bg-amber-50 rounded-2xl shadow-sm border border-amber-100 p-5">
            <p class="text-xs font-medium text-amber-500 uppercase tracking-wider">Menunggu</p>
            <p class="text-3xl font-bold text-amber-600 mt-1">{{ $menunggu }}</p>
            <p class="text-xs text-amber-400 mt-1">belum diproses</p>
        </div>
        <div class="bg-blue-50 rounded-2xl shadow-sm border border-blue-100 p-5">
            <p class="text-xs font-medium text-blue-500 uppercase tracking-wider">Diproses</p>
            <p class="text-3xl font-bold text-blue-600 mt-1">{{ $diproses }}</p>
            <p class="text-xs text-blue-400 mt-1">sedang ditangani</p>
        </div>
        <div class="bg-green-50 rounded-2xl shadow-sm border border-green-100 p-5">
            <p class="text-xs font-medium text-green-500 uppercase tracking-wider">Selesai</p>
            <p class="text-3xl font-bold text-green-600 mt-1">{{ $selesai }}</p>
            <p class="text-xs text-green-400 mt-1">terselesaikan</p>
        </div>
    </div>

    {{-- Recent Pengaduan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-semibold text-slate-800">Pengaduan Terbaru</h3>
            <a href="{{ route('pengaduan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Buat Pengaduan
            </a>
        </div>
        @if($myPengaduans->isEmpty())
            <div class="text-center py-16">
                <svg class="w-16 h-16 text-slate-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <p class="text-slate-400 font-medium">Belum ada pengaduan</p>
                <p class="text-slate-300 text-sm mt-1">Klik tombol di atas untuk membuat pengaduan pertamamu</p>
            </div>
        @else
            <div class="divide-y divide-slate-100">
                @foreach($myPengaduans->take(5) as $p)
                    <a href="{{ route('pengaduan.show', $p->id) }}" class="flex items-center gap-4 px-6 py-4 hover:bg-slate-50 transition-colors">
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-slate-800 truncate">{{ $p->judul }}</p>
                            <p class="text-sm text-slate-400">{{ $p->kategori->nama_kategori ?? '-' }} · {{ $p->created_at->diffForHumans() }}</p>
                        </div>
                        @php
                            $badge = match($p->status) {
                                'Menunggu' => 'bg-amber-100 text-amber-700',
                                'Diproses' => 'bg-blue-100 text-blue-700',
                                'Selesai'  => 'bg-green-100 text-green-700',
                                'Ditolak'  => 'bg-red-100 text-red-700',
                                default    => 'bg-slate-100 text-slate-600',
                            };
                        @endphp
                        <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $badge }}">{{ $p->status }}</span>
                    </a>
                @endforeach
            </div>
            @if($myPengaduans->count() > 5)
                <div class="px-6 py-3 border-t border-slate-100 text-center">
                    <a href="{{ route('pengaduan.index') }}" class="text-blue-600 text-sm font-medium hover:underline">Lihat semua pengaduan →</a>
                </div>
            @endif
        @endif
    </div>
</x-app-layout>
