<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.kategori.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-xl font-bold text-slate-800">Tambah Kategori</h1>
        </div>
    </x-slot>

    <div class="max-w-md">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5" for="nama_kategori">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="nama_kategori"
                        id="nama_kategori"
                        value="{{ old('nama_kategori') }}"
                        placeholder="Contoh: Keamanan Kampus"
                        class="w-full border {{ $errors->has('nama_kategori') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        autofocus
                    >
                    @error('nama_kategori')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition-colors shadow-sm">
                        Simpan Kategori
                    </button>
                    <a href="{{ route('admin.kategori.index') }}" class="px-6 py-3 border border-slate-200 text-slate-600 rounded-xl hover:bg-slate-50 transition-colors font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
