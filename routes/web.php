<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user_control;
use App\Http\Controllers\kategoricontroller;
use App\Http\Controllers\produkcontroller;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ModalAwalController;

/*
|--------------------------------------------------------------------------
| ROUTE UMUM
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('auth.login'));

// Search & Detail Produk
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/produk/{id}/detail', [produkcontroller::class, 'detail'])->name('produk.detail');

// Midtrans
Route::post('/midtrans-token', [MidtransController::class, 'transaksi'])->name('midtrans.token');
Route::post('/update-status', [TransaksiController::class, 'updateStatus'])->name('update.status');
Route::post('/update-status2', [MidtransController::class, 'updateStatus2'])->name('update.status2');

/*
|--------------------------------------------------------------------------
| CUSTOMER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::match(['get', 'post'], '/profile', [user_control::class, 'profile'])->name('profile');
    Route::get('/histori', [TransaksiController::class, 'index']);
    Route::get('/order', [produkcontroller::class, 'order']);
    Route::get('/keranjang', fn () => view('keranjang'));
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', fn () => view('dashboard_admin.admin'))->name('dashboard');

    // Produk
    Route::get('/tampil-produk', [produkcontroller::class, 'index'])->name('produk.index');
    Route::get('/tambah-produk', [produkcontroller::class, 'create'])->name('produk.create');
    Route::post('/tampil-produk', [produkcontroller::class, 'store'])->name('produk.store');
    Route::get('/produk/edit/{id}', [produkcontroller::class, 'edit'])->name('produk.edit');
    Route::post('/produk/edit/{id}', [produkcontroller::class, 'update'])->name('produk.update');
    Route::delete('/produk/delete/{id}', [produkcontroller::class, 'destroy'])->name('produk.delete');

    // Stok masuk
    Route::get('/stok-masuk', [produkcontroller::class, 'indexStokMasuk'])->name('stok-masuk');
    Route::get('/stok-masuk/form', [produkcontroller::class, 'indexStokMasukForm'])->name('stok-masuk.form');
    Route::post('/stok-masuk/store', [produkcontroller::class, 'stokMasukStore'])->name('stok-masuk.store');
    Route::get('/stok-masuk/export-pdf', [ProdukController::class, 'exportStokMasukPDF'])->name('stok-masuk.export-pdf');

    // Stok keluar
    Route::get('/stok-keluar', [produkcontroller::class, 'indexStokKeluar'])->name('stok-keluar');
    Route::get('/stok-keluar/form', [produkcontroller::class, 'indexStokKeluarForm'])->name('stok-keluar.form');
    Route::post('/stok-keluar/store', [produkcontroller::class, 'stokKeluarStore'])->name('stok-keluar.store');
    Route::get('/stok-keluar/export-pdf', [produkcontroller::class, 'exportStokKeluarPdf'])->name('stok-keluar.export-pdf');

    // Stok opname
    Route::get('/stok-opname', [produkcontroller::class, 'indexStokOpname'])->name('stok-opname');
    Route::get('/stok-opname/form', [produkcontroller::class, 'indexStokOpnameForm'])->name('stok-opname.form');
    Route::post('/stok-opname/store', [produkcontroller::class, 'stokOpnameStore'])->name('stok-opname.store');
    Route::get('/stok-opname/export-pdf', [ProdukController::class, 'exportStokOpnamePDF'])->name('stok-opname.export-pdf');
    Route::get('/produk/opname', [produkcontroller::class, 'opname'])->name('produk.opname');
    Route::get('/produk/histori-opname', [produkcontroller::class, 'historiOpname'])->name('produk.opname.histori');
    Route::post('/produk/opname/update', [produkcontroller::class, 'updateStokOpname'])->name('produk.opname.update');
    

    // Produk search
    Route::get('/produk/search', [produkcontroller::class, 'stokMasukSearch'])->name('produk.search');

    // Kategori
    Route::controller(kategoricontroller::class)->group(function () {
        Route::get('/tampil-kategori', 'index')->name('kategori.index');
        Route::get('/tambah-kategori', 'create')->name('kategori.create');
        Route::post('/tampil-kategori', 'store')->name('kategori.store');
        Route::get('/kategori/edit/{id}', 'edit')->name('kategori.edit');
        Route::post('/kategori/edit/{id}', 'update')->name('kategori.update');
        Route::post('/kategori/delete/{id}', 'destroy')->name('kategori.delete');
    });

    // Transaksi admin
    Route::get('/tampil-transaksi', [TransaksiController::class, 'indexAdmin'])->name('transaksi.index');
    Route::post('/transaksi/sampai/{id}', [TransaksiController::class, 'sampai'])->name('transaksi.sampai');
});

/*
|--------------------------------------------------------------------------
| OWNER
|--------------------------------------------------------------------------
*/
Route::prefix('owner')->middleware(['auth', 'owner'])->group(function () {
    // Dashboard
    Route::get('/', [LaporanController::class, 'dashboard_owner_index'])->name('dashboard_owner.owner');

    // Modal Awal
    Route::post('/modal-awal/store', [ModalAwalController::class, 'store'])->name('owner.modal.store');
    Route::put('/modal-awal/{id}', [ModalAwalController::class, 'update'])->name('owner.modal.update');
    Route::delete('/modal-awal/{id}', [ModalAwalController::class, 'destroy'])->name('modalAwal.destroy');

    // Data User
    Route::get('/tampil-User', [user_control::class, 'index'])->name('owner.user.index');

    // Laporan
    Route::get('/dashboard_owner', [LaporanController::class, 'dashboard_owner_index'])->name('dashboard.owner');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/cari', [LaporanController::class, 'cari'])->name('laporan.cari');
    Route::get('/laporan/export/excel', [LaporanController::class, 'excel'])->name('laporan.excel');
    Route::get('/laporan/export/pdf', [LaporanController::class, 'pdf'])->name('laporan.pdf');
    Route::get('/laporan/chart', [LaporanController::class, 'chart'])->name('laporan.chart');
    Route::get('/laporan/produk-terlaris', [LaporanController::class, 'produkTerlaris'])->name('laporan.produkTerlaris');
    Route::get('/laporan/ongkir', [LaporanController::class, 'laporanOngkir'])->name('laporan.ongkir');
    Route::get('/laporan/ongkir/export/excel', [LaporanController::class, 'excelOngkir'])->name('laporan.ongkir.excel');
    Route::get('/laporan/ongkir/export/pdf', [LaporanController::class, 'pdfOngkir'])->name('laporan.ongkir.pdf');
    Route::put('/laporan/update/biaya-operasional', [LaporanController::class, 'update_operasioanl'])->name('laporan.operasioanl.update');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::post('/login', [user_control::class, 'login'])->name('login.post');

    // Register
    Route::get('/register', fn () => view('auth.register'))->name('register.form');
    Route::post('/register', [user_control::class, 'register'])->name('register');
});

// Logout
Route::post('/logout', [user_control::class, 'logout'])->name('logout');

// Update profit (laporan)
Route::post('/laporan/update-profit', [LaporanController::class, 'updateProfit'])->name('laporan.updateProfit');
