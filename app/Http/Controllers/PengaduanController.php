<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::with(['kategori', 'user'])
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('pengaduan.index', compact('pengaduans'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('pengaduan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul'       => 'required|string|max:255',
            'lokasi'      => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'judul.required'       => 'Judul wajib diisi.',
            'lokasi.required'      => 'Lokasi wajib diisi.',
            'deskripsi.required'   => 'Deskripsi wajib diisi.',
            'foto.image'           => 'File harus berupa gambar.',
            'foto.max'             => 'Ukuran foto maksimal 2MB.',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
        }

        Pengaduan::create([
            'user_id'     => Auth::id(),
            'kategori_id' => $request->kategori_id,
            'judul'       => $request->judul,
            'lokasi'      => $request->lokasi,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $fotoPath,
            'status'      => 'Menunggu',
        ]);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim! Kami akan segera menindaklanjutinya.');
    }

    public function show(Pengaduan $pengaduan)
    {
        // Pastikan hanya pemilik yang bisa lihat
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403);
        }
        return view('pengaduan.show', compact('pengaduan'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403);
        }
        if ($pengaduan->status !== 'Menunggu') {
            return redirect()->route('pengaduan.index')
                ->with('error', 'Pengaduan yang sudah diproses tidak dapat diedit.');
        }
        $kategoris = Kategori::all();
        return view('pengaduan.edit', compact('pengaduan', 'kategoris'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul'       => 'required|string|max:255',
            'lokasi'      => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'judul.required'       => 'Judul wajib diisi.',
            'lokasi.required'      => 'Lokasi wajib diisi.',
            'deskripsi.required'   => 'Deskripsi wajib diisi.',
        ]);

        $fotoPath = $pengaduan->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
        }

        $pengaduan->update([
            'kategori_id' => $request->kategori_id,
            'judul'       => $request->judul,
            'lokasi'      => $request->lokasi,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $fotoPath,
        ]);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403);
        }

        if ($pengaduan->foto) {
            Storage::disk('public')->delete($pengaduan->foto);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}