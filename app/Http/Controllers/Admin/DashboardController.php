<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Kategori;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengaduan  = Pengaduan::count();
        $menunggu        = Pengaduan::where('status', 'Menunggu')->count();
        $diproses        = Pengaduan::where('status', 'Diproses')->count();
        $selesai         = Pengaduan::where('status', 'Selesai')->count();
        $ditolak         = Pengaduan::where('status', 'Ditolak')->count();
        $totalKategori   = Kategori::count();
        $totalMahasiswa  = User::role('mahasiswa')->count();

        $pengaduanTerbaru = Pengaduan::with(['user', 'kategori'])
                                ->latest()
                                ->take(5)
                                ->get();

        $perKategori = Kategori::withCount('pengaduans')->get();

        return view('admin.dashboard', compact(
            'totalPengaduan',
            'menunggu',
            'diproses',
            'selesai',
            'ditolak',
            'totalKategori',
            'totalMahasiswa',
            'pengaduanTerbaru',
            'perKategori'
        ));
    }
}
