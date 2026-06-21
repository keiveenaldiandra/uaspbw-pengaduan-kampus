<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-bold text-slate-800">Pengaduan Saya</h1>
    </x-slot>

    <div class="flex items-center justify-between mb-6">
        <p class="text-slate-500">Daftar semua pengaduan yang kamu kirimkan.</p>
        <a href="{{ route('pengaduan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-xl transition-colors flex items-center gap-2 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Pengaduan
        </a>
    </div>

    @if($pengaduans->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 text-center py-20">
            <svg class="w-20 h-20 text-slate-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
            <p class="text-slate-500 font-semibold text-lg">Belum ada pengaduan</p>
            <p class="text-slate-400 text-sm mt-1">Klik tombol di atas untuk membuat pengaduan baru.</p>
        </div>
    @else
        <div class="grid gap-4">
            @foreach($pengaduans as $pengaduan)
                @php
                    $badge = match($pengaduan->status) {
                        'Menunggu' => 'bg-amber-100 text-amber-700 border-amber-200',
                        'Diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                        'Selesai'  => 'bg-green-100 text-green-700 border-green-200',
                        'Ditolak'  => 'bg-red-100 text-red-700 border-red-200',
                        default    => 'bg-slate-100 text-slate-600',
                    };
                    $dot = match($pengaduan->status) {
                        'Menunggu' => 'bg-amber-400',
                        'Diproses' => 'bg-blue-400',
                        'Selesai'  => 'bg-green-400',
                        'Ditolak'  => 'bg-red-400',
                        default    => 'bg-slate-400',
                    };
                @endphp
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full border {{ $badge }} flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $dot }}"></span>
                                    {{ $pengaduan->status }}
                                </span>
                                <span class="text-xs text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">{{ $pengaduan->kategori->nama_kategori ?? '-' }}</span>
                            </div>
                            <h3 class="font-semibold text-slate-800 text-lg leading-snug">{{ $pengaduan->judul }}</h3>
                            <div class="flex items-center gap-4 mt-2 text-sm text-slate-400">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $pengaduan->lokasi }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $pengaduan->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <a href="{{ route('pengaduan.show', $pengaduan->id) }}" class="text-slate-500 hover:text-blue-600 bg-slate-100 hover:bg-blue-50 p-2 rounded-lg transition-colors" title="Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            @if($pengaduan->status === 'Menunggu')
                                <a href="{{ route('pengaduan.edit', $pengaduan->id) }}" class="text-slate-500 hover:text-amber-600 bg-slate-100 hover:bg-amber-50 p-2 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <form action="{{ route('pengaduan.destroy', $pengaduan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-slate-500 hover:text-red-600 bg-slate-100 hover:bg-red-50 p-2 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>