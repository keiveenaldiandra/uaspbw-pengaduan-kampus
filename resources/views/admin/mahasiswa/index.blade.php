<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-bold text-slate-800">Data Mahasiswa</h1>
    </x-slot>

    <div class="mb-6">
        <p class="text-slate-500 text-sm">Terdapat {{ $mahasiswas->count() }} mahasiswa yang terdaftar di sistem.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Mahasiswa</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-center">Bergabung Pada</th>
                    <th class="px-6 py-3 text-center">Total Pengaduan</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($mahasiswas as $mhs)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 text-slate-400">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-blue-600 font-bold text-sm">{{ substr($mhs->name, 0, 1) }}</span>
                                </div>
                                <span class="font-semibold text-slate-800">{{ $mhs->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-500">
                            {{ $mhs->email }}
                        </td>
                        <td class="px-6 py-4 text-center text-slate-500">
                            {{ $mhs->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($mhs->pengaduans_count > 0)
                                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">{{ $mhs->pengaduans_count }} Laporan</span>
                            @else
                                <span class="text-slate-400 text-xs font-medium px-3 py-1 border border-slate-200 rounded-full">Belum ada laporan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center">
                                <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini secara permanen?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-16 text-slate-400">
                            <svg class="w-12 h-12 mx-auto mb-3 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            Belum ada mahasiswa yang terdaftar
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
