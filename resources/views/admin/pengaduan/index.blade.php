<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-bold text-slate-800">Kelola Pengaduan</h1>
    </x-slot>

    {{-- Filter Bar --}}
    <form method="GET" action="{{ route('admin.pengaduan.index') }}" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-6 flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-48">
            <label class="block text-xs font-semibold text-slate-500 mb-1">Cari Judul</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik judul pengaduan..." class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="min-w-36">
            <label class="block text-xs font-semibold text-slate-500 mb-1">Status</label>
            <select name="status" class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Status</option>
                @foreach(['Menunggu','Diproses','Selesai','Ditolak'] as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
        </div>
        <div class="min-w-40">
            <label class="block text-xs font-semibold text-slate-500 mb-1">Kategori</label>
            <select name="kategori_id" class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2 rounded-xl transition-colors">Filter</button>
        @if(request()->anyFilled(['search','status','kategori_id']))
            <a href="{{ route('admin.pengaduan.index') }}" class="text-sm text-slate-500 hover:text-slate-700 px-3 py-2">Reset</a>
        @endif
    </form>

    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <p class="text-sm text-slate-500">Total: <span class="font-semibold text-slate-800">{{ $pengaduans->total() }}</span> pengaduan</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Judul</th>
                        <th class="px-6 py-3 text-left">Pelapor</th>
                        <th class="px-6 py-3 text-left">Kategori</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pengaduans as $p)
                        @php
                            $badge = match($p->status) {
                                'Menunggu' => 'bg-amber-100 text-amber-700',
                                'Diproses' => 'bg-blue-100 text-blue-700',
                                'Selesai'  => 'bg-green-100 text-green-700',
                                'Ditolak'  => 'bg-red-100 text-red-700',
                                default    => 'bg-slate-100 text-slate-600',
                            };
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-slate-400">{{ $pengaduans->firstItem() + $loop->index }}</td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-slate-800 max-w-xs truncate">{{ $p->judul }}</p>
                                <p class="text-xs text-slate-400 truncate max-w-xs">{{ $p->lokasi }}</p>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $p->user->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $p->kategori->nama_kategori ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $badge }}">{{ $p->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-slate-400 whitespace-nowrap">{{ $p->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.pengaduan.show', $p->id) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors">Detail</a>
                                    <form action="{{ route('admin.pengaduan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus pengaduan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-16 text-slate-400">
                                <svg class="w-12 h-12 mx-auto mb-3 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Tidak ada pengaduan ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pengaduans->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $pengaduans->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
