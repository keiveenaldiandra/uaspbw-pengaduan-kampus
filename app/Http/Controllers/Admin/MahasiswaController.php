<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Ambil semua user yang memiliki role 'mahasiswa'
        $mahasiswas = User::role('mahasiswa')
                        ->withCount('pengaduans') // Menghitung jumlah laporan per mahasiswa
                        ->latest()
                        ->get();

        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function destroy(User $mahasiswa)
    {
        // Hanya izinkan menghapus role mahasiswa
        if ($mahasiswa->hasRole('mahasiswa')) {
            $mahasiswa->delete();
            return back()->with('status', 'Akun mahasiswa berhasil dihapus.');
        }

        return back()->with('error', 'Tidak dapat menghapus pengguna ini.');
    }
}
