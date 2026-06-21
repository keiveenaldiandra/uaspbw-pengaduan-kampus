<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-bold text-slate-800">Edit Pengaduan</h1>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
            <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Kategori --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5" for="kategori_id">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori_id" id="kategori_id" class="w-full border {{ $errors->has('kategori_id') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-xl px-4 py-2.5 text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $pengaduan->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Judul --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5" for="judul">Judul Pengaduan <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $pengaduan->judul) }}" class="w-full border {{ $errors->has('judul') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-xl px-4 py-2.5 text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Lokasi --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5" for="lokasi">Lokasi <span class="text-red-500">*</span></label>
                    <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $pengaduan->lokasi) }}" class="w-full border {{ $errors->has('lokasi') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-xl px-4 py-2.5 text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    @error('lokasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5" for="deskripsi">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" id="deskripsi" rows="5" class="w-full border {{ $errors->has('deskripsi') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-xl px-4 py-2.5 text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none">{{ old('deskripsi', $pengaduan->deskripsi) }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Foto --}}
                <div class="mb-7">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Foto Bukti <span class="text-slate-400 font-normal">(opsional, biarkan kosong untuk tidak mengubah)</span></label>
                    @if($pengaduan->foto)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto saat ini" class="w-40 h-32 object-cover rounded-xl border border-slate-200">
                            <p class="text-xs text-slate-400 mt-1">Foto saat ini</p>
                        </div>
                    @endif
                    <div class="border-2 border-dashed border-slate-200 rounded-xl p-5 text-center hover:border-blue-400 transition-colors cursor-pointer" onclick="document.getElementById('foto').click()">
                        <svg class="w-8 h-8 text-slate-300 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-sm text-slate-400" id="foto-label">Klik untuk ganti foto</p>
                        <input type="file" name="foto" id="foto" accept="image/*" class="hidden" onchange="document.getElementById('foto-label').textContent = this.files[0]?.name || 'Klik untuk ganti foto'">
                    </div>
                    @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 rounded-xl transition-colors shadow-sm">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('pengaduan.index') }}" class="px-6 py-3 border border-slate-200 text-slate-600 rounded-xl hover:bg-slate-50 transition-colors font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>