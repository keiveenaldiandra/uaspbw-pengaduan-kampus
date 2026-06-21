<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('pengaduan.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-xl font-bold text-slate-800">Detail Pengaduan</h1>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        @php
            $badge = match($pengaduan->status) {
                'Menunggu' => 'bg-amber-100 text-amber-700 border-amber-200',
                'Diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                'Selesai'  => 'bg-green-100 text-green-700 border-green-200',
                'Ditolak'  => 'bg-red-100 text-red-700 border-red-200',
                default    => 'bg-slate-100 text-slate-600',
            };
        @endphp

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            {{-- Header Card --}}
            <div class="p-6 border-b border-slate-100">
                <span class="text-xs font-semibold px-3 py-1 rounded-full border {{ $badge }}">{{ $pengaduan->status }}</span>
                <h2 class="text-2xl font-bold text-slate-800 mt-3">{{ $pengaduan->judul }}</h2>
                <div class="flex flex-wrap gap-4 mt-3 text-sm text-slate-400">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        {{ $pengaduan->kategori->nama_kategori ?? '-' }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $pengaduan->lokasi }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $pengaduan->created_at->locale('id')->isoFormat('D MMMM Y, HH:mm') }}
                    </span>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="p-6 border-b border-slate-100">
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Deskripsi</h3>
                <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $pengaduan->deskripsi }}</p>
            </div>

            {{-- Foto --}}
            @if($pengaduan->foto)
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Foto Bukti</h3>
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan" class="rounded-xl max-w-full max-h-80 object-cover border border-slate-200">
                </div>
            @endif

            {{-- Timeline Status --}}
            <div class="p-6">
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Riwayat Status</h3>
                <div class="flex items-center gap-0">
                    @foreach(['Menunggu','Diproses','Selesai'] as $i => $s)
                        @php
                            $statuses = ['Menunggu','Diproses','Selesai','Ditolak'];
                            $currentIdx = array_search($pengaduan->status, $statuses);
                            $thisIdx = array_search($s, $statuses);
                            $done = $currentIdx >= $thisIdx && $pengaduan->status !== 'Ditolak';
                            $active = $pengaduan->status === $s;
                        @endphp
                        <div class="flex items-center {{ $i < 2 ? 'flex-1' : '' }}">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold {{ $done ? 'bg-blue-600 text-white' : 'bg-slate-200 text-slate-400' }} {{ $active ? 'ring-4 ring-blue-200' : '' }}">
                                    @if($done && !$active)
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    @else
                                        {{ $thisIdx + 1 }}
                                    @endif
                                </div>
                                <p class="text-xs mt-1 {{ $done ? 'text-blue-600 font-semibold' : 'text-slate-400' }}">{{ $s }}</p>
                            </div>
                            @if($i < 2)
                                <div class="flex-1 h-0.5 mx-2 {{ $done && $currentIdx > $thisIdx ? 'bg-blue-600' : 'bg-slate-200' }}"></div>
                            @endif
                        </div>
                    @endforeach
                    @if($pengaduan->status === 'Ditolak')
                        <div class="ml-4 flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                            </div>
                            <p class="text-xs mt-1 text-red-500 font-semibold">Ditolak</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Actions --}}
        @if($pengaduan->status === 'Menunggu')
            <div class="flex gap-3 mt-4">
                <a href="{{ route('pengaduan.edit', $pengaduan->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-2.5 rounded-xl transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    Edit Pengaduan
                </a>
                <form action="{{ route('pengaduan.destroy', $pengaduan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 font-semibold px-6 py-2.5 rounded-xl border border-red-200 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Hapus
                    </button>
                </form>
            </div>
        @endif
    </div>
</x-app-layout>
