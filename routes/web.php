<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\SimpleController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Route::get('/', [SimpleController::class, 'index']);
// Route::post('/simpan', [SimpleController::class, 'store']);
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::middleware('auth')->group(function () {
   Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/barang/create', [BarangController::class,  'create'])->name('barang.create');
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
// Route::resource('peminjaman', PeminjamanController::class);
Route::resource('peminjaman', PeminjamanController::class)->except(['show']);

Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
Route::post('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');

Route::get('/peminjaman/pengembalian', [PeminjamanController::class, 'pengembalian'])->name('peminjaman.pengembalian');
Route::post('/peminjaman/kembalikan/{id}', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
// Route::resource('peminjaman', PeminjamanController::class)->except(['show']);
Route::post('/peminjaman/approve-pengembalian/{id}', [PeminjamanController::class, 'approvePengembalian'])->name('peminjaman.approvePengembalian');
Route::get('/laporan/peminjaman', [PeminjamanController::class, 'laporan'])->name('peminjaman.laporan');

});
