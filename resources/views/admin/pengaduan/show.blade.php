<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.pengaduan.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-xl font-bold text-slate-800">Detail Pengaduan</h1>
        </div>
    </x-slot>

    <div class="grid lg:grid-cols-3 gap-6">
        {{-- Detail Pengaduan --}}
        <div class="lg:col-span-2 space-y-4">
            @php
                $badge = match($pengaduan->status) {
                    'Menunggu' => 'bg-amber-100 text-amber-700 border-amber-200',
                    'Diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                    'Selesai'  => 'bg-green-100 text-green-700 border-green-200',
                    'Ditolak'  => 'bg-red-100 text-red-700 border-red-200',
                    default    => 'bg-slate-100 text-slate-600',
                };
            @endphp

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex items-start justify-between gap-3 mb-4">
                    <span class="text-xs font-semibold px-3 py-1 rounded-full border {{ $badge }}">{{ $pengaduan->status }}</span>
                    <span class="text-xs text-slate-400">{{ $pengaduan->created_at->locale('id')->isoFormat('D MMMM Y, HH:mm') }}</span>
                </div>
                <h2 class="text-xl font-bold text-slate-800 mb-3">{{ $pengaduan->judul }}</h2>
                <div class="flex flex-wrap gap-4 text-sm text-slate-500 mb-5">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        {{ $pengaduan->kategori->nama_kategori ?? '-' }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $pengaduan->lokasi }}
                    </span>
                </div>

                <div class="bg-slate-50 rounded-xl p-4">
                    <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Deskripsi</h3>
                    <p class="text-slate-700 leading-relaxed whitespace-pre-wrap text-sm">{{ $pengaduan->deskripsi }}</p>
                </div>
            </div>

            {{-- Foto --}}
            @if($pengaduan->foto)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Foto Bukti</h3>
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto" class="rounded-xl max-w-full max-h-80 object-cover border border-slate-200">
                </div>
            @endif

            {{-- Pelapor --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Data Pelapor</h3>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-blue-600 font-bold text-lg">{{ substr($pengaduan->user->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800">{{ $pengaduan->user->name }}</p>
                        <p class="text-sm text-slate-400">{{ $pengaduan->user->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Update Status --}}
        <div class="space-y-4">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-semibold text-slate-800 mb-4">Perbarui Status</h3>
                <form action="{{ route('admin.pengaduan.updateStatus', $pengaduan->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="space-y-2 mb-4">
                        @foreach(['Menunggu' => 'amber', 'Diproses' => 'blue', 'Selesai' => 'green', 'Ditolak' => 'red'] as $s => $color)
                            <label class="flex items-center gap-3 p-3 rounded-xl border-2 cursor-pointer transition-all {{ $pengaduan->status === $s ? 'border-'.$color.'-400 bg-'.$color.'-50' : 'border-slate-200 hover:border-slate-300' }}">
                                <input type="radio" name="status" value="{{ $s }}" {{ $pengaduan->status === $s ? 'checked' : '' }} class="accent-blue-600">
                                <span class="text-sm font-medium text-slate-700">{{ $s }}</span>
                            </label>
                        @endforeach
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl transition-colors shadow-sm">
                        Simpan Status
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-semibold text-slate-800 mb-3">Hapus Pengaduan</h3>
                <p class="text-sm text-slate-400 mb-4">Tindakan ini tidak bisa dibatalkan.</p>
                <form action="{{ route('admin.pengaduan.destroy', $pengaduan->id) }}" method="POST" onsubmit="return confirm('Yakin hapus pengaduan ini secara permanen?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full bg-red-50 hover:bg-red-100 border border-red-200 text-red-600 font-semibold py-2.5 rounded-xl transition-colors">
                        Hapus Pengaduan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
