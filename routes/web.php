<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengaduanAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Redirect dashboard berdasarkan role
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Mahasiswa Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::resource('pengaduan', PengaduanController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Pengaduan
    Route::get('/pengaduan', [PengaduanAdminController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{pengaduan}', [PengaduanAdminController::class, 'show'])->name('pengaduan.show');
    Route::patch('/pengaduan/{pengaduan}/status', [PengaduanAdminController::class, 'updateStatus'])->name('pengaduan.updateStatus');
    Route::delete('/pengaduan/{pengaduan}', [PengaduanAdminController::class, 'destroy'])->name('pengaduan.destroy');

    // Data Mahasiswa
    Route::get('/mahasiswa', [\App\Http\Controllers\Admin\MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::delete('/mahasiswa/{mahasiswa}', [\App\Http\Controllers\Admin\MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

    // Kelola Kategori
    Route::resource('kategori', KategoriController::class)->names([
        'index'   => 'kategori.index',
        'create'  => 'kategori.create',
        'store'   => 'kategori.store',
        'show'    => 'kategori.show',
        'edit'    => 'kategori.edit',
        'update'  => 'kategori.update',
        'destroy' => 'kategori.destroy',
    ]);
});

require __DIR__ . '/auth.php';