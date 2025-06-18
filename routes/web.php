<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Pembeli\PembeliDashboardController;
use App\Http\Controllers\Pembeli\PembeliProdukController;
use App\Http\Controllers\Penjual\PenjualDashboardController;
use App\Http\Controllers\Penjual\PenjualProdukController1;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ✅ Login sukses redirect berdasarkan role
    Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard_admin');
    Route::get('/seller/dashboard', [PenjualDashboardController::class, 'index'])->name('produkPenjual.dashboard_penjual');
    Route::get('/customer/dashboard', [PembeliDashboardController::class, 'index'])->name('pembeli.dashboard_pembeli');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/profile/penjual', [ProfileController::class, 'penjual'])->name('profile.penjual');
    Route::get('/profile/pembeli', [ProfileController::class, 'pembeli'])->name('profile.pembeli');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil/hapus', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




    Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Tambahan: Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard_admin');

    // Resource lainnya
    Route::resource('user', UserController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('transaksi', TransaksiController::class);
});

    // Menu PENJUAL
    Route::middleware('auth')->prefix('penjual')->name('penjual.')->group(function () {
        Route::resource('produkPenjual', PenjualProdukController1::class);
        Route::get('transaksi', [PenjualProdukController1::class, 'transaksiMasuk'])->name('transaksi.masuk');
    });

Route::middleware(['auth'])->prefix('pembeli')->name('pembeli.')->group(function () {
    Route::get('/produk', [PembeliProdukController::class, 'index'])->name('produk');

    Route::get('/produk/checkout/{id}', [PembeliProdukController::class, 'showCheckoutForm'])->name('produk.checkout.form');

    Route::post('/produk/checkout', [PembeliProdukController::class, 'prosesCheckout'])->name('produk.checkout');

    Route::get('/pesanan', [PembeliProdukController::class, 'pesanan'])->name('pesanan');
});

require __DIR__.'/auth.php';
