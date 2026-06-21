<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PengaduanAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with(['kategori', 'user'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $pengaduans = $query->paginate(10)->withQueryString();
        $kategoris  = Kategori::all();

        return view('admin.pengaduan.index', compact('pengaduans', 'kategoris'));
    }

    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load(['user', 'kategori']);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai,Ditolak',
        ]);

        $pengaduan->update(['status' => $request->status]);

        return redirect()->route('admin.pengaduan.show', $pengaduan->id)
            ->with('success', 'Status pengaduan berhasil diperbarui menjadi "' . $request->status . '".');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->foto) {
            \Storage::disk('public')->delete($pengaduan->foto);
        }
        $pengaduan->delete();

        return redirect()->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
