<?php

use App\Http\Controllers\AlgoritmaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FakturController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\LaporanHarianController;
use App\Http\Controllers\LaporanTransaksiController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PenggunaanBarangController;
use App\Http\Controllers\PenjemputanLaundryController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
   Route::view('/', 'pages.home.index');
   Route::get('members', [MemberController::class, 'index']);
   Route::get('members/getData', [MemberController::class, 'getData']);
   Route::post('members/store', [MemberController::class, 'store'])->name('members.store');
   Route::post('members/update', [MemberController::class, 'update'])->name('members.update');
   Route::post('members/destroy', [MemberController::class, 'destroy'])->name('members.destroy');
   Route::get('members/export', [MemberController::class, 'export'])->name('members.export');
   Route::post('members/import', [MemberController::class, 'import'])->name('members.import');

   Route::get('kurir', [KurirController::class, 'index']);
   Route::get('kurir/getData', [KurirController::class, 'getData']);
   Route::post('kurir/store', [KurirController::class, 'store'])->name('kurir.store');
   Route::post('kurir/update', [KurirController::class, 'update'])->name('kurir.update');
   Route::post('kurir/destroy', [KurirController::class, 'destroy'])->name('kurir.destroy');

   Route::get('outlets', [OutletController::class, 'index']);
   Route::get('outlets/getData', [OutletController::class, 'getData']);
   Route::post('outlets/store', [OutletController::class, 'store'])->name('outlets.store');
   Route::post('outlets/update', [OutletController::class, 'update'])->name('outlets.update');
   Route::post('outlets/destroy', [OutletController::class, 'destroy'])->name('outlets.destroy');
   Route::get('outlets/export', [OutletController::class, 'export'])->name('outlets.export');
   Route::post('outlets/import', [OutletController::class, 'import'])->name('outlets.import');

   Route::get('packages', [PaketController::class, 'index']);
   Route::get('packages/getData', [PaketController::class, 'getData']);
   Route::post('packages/store', [PaketController::class, 'store'])->name('packages.store');
   Route::post('packages/update', [PaketController::class, 'update'])->name('packages.update');
   Route::post('packages/destroy', [PaketController::class, 'destroy'])->name('packages.destroy');
   Route::get('packages/export', [PaketController::class, 'export'])->name('packages.export');
   Route::post('packages/import', [PaketController::class, 'import'])->name('packages.import');

   Route::view('penggunaan-barang', 'pages.penggunaan_barang.index');
   Route::get('penggunaan-barang/getData', [PenggunaanBarangController::class, 'getData']);
   Route::post('penggunaan-barang/store', [PenggunaanBarangController::class, 'store']);
   Route::post('penggunaan-barang/update', [PenggunaanBarangController::class, 'update']);
   Route::post('penggunaan-barang/updateStatus', [PenggunaanBarangController::class, 'updateStatus']);
   Route::post('penggunaan-barang/destroy', [PenggunaanBarangController::class, 'destroy']);
   Route::get('penggunaan-barang/export', [PenggunaanBarangController::class, 'export']);

   Route::get('users', [UserController::class, 'index']);
   Route::get('users/getData', [UserController::class, 'getData']);
   Route::post('users/store', [UserController::class, 'store'])->name('users.store');
   Route::post('users/update', [UserController::class, 'update'])->name('users.update');
   Route::post('users/destroy', [UserController::class, 'destroy'])->name('users.destroy');
   Route::post('users/changePassword', [UserController::class, 'changePassword'])->name('users.changePassword');

   Route::view('transactions', 'pages.transaction.index');
   Route::get('transactions/getData', [TransaksiController::class, 'showTransactions'])->name('transactions.getData');
   Route::post('transactions/updateStatus', [TransaksiController::class, 'updateStatus']);
   Route::get('transaction/new', [TransaksiController::class, 'showNewTransaction'])->name('transaction.new');
   Route::post('transaction/new/store', [TransaksiController::class, 'store'])->name('transaction.store');

   Route::view('transaction/penjemputan-laundry', 'pages.penjemputan.index');
   Route::get('transaction/penjemputan-laundry/showDataPenjemputan', [PenjemputanLaundryController::class, 'showPenjemputanLaundry']);
   Route::get('transaction/penjemputan-laundry/getTransactionStatus', [PenjemputanLaundryController::class, 'getDataTransactionSelesai']);
   Route::get('transaction/penjemputan-laundry/getDataKurir', [PenjemputanLaundryController::class, 'getDataKurir']);
   Route::post('transaction/penjemputan-laundry/store', [PenjemputanLaundryController::class, 'store'])->name('penjemputan-laundry.store');
   Route::post('transaction/penjemputan-laundry/updateStatus', [PenjemputanLaundryController::class, 'updateStatus'])->name('penjemputan-laundry.updateStatus');
   Route::post('transaction/penjemputan-laundry/update', [PenjemputanLaundryController::class, 'update'])->name('penjemputan-laundry.update');
   Route::post('transaction/penjemputan-laundry/destroy', [PenjemputanLaundryController::class, 'destroy'])->name('penjemputan-laundry.destroy');
   Route::get('transaction/penjemputan-laundry/export', [PenjemputanLaundryController::class, 'export'])->name('penjemputan-laundry.export');

   Route::view('laporan/transaksi', 'pages.laporan.transaksi.index');
   Route::post('laporan/transaksi/getLaporanTransaksi', [LaporanTransaksiController::class, 'getLaporanTransaksi']);
   // Route::view('laporan/harian', 'pages.laporan.harian.index');
   Route::get('laporan/harian', [LaporanHarianController::class, 'showLaporanHarian']);

   Route::get('faktur/{inv}', FakturController::class)->name('faktur');

   Route::get('algoritma', [AlgoritmaController::class, 'view']);
   Route::view('simulasi', 'pages.simulasi.index');

   Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:kasir'])->group(function () {

});

Route::middleware(['auth', 'role:owner'])->group(function () {

});


Route::middleware('guest')->group(function () {
   Route::view('login', 'pages.auth.login')->name('login');
   Route::post('login/check', [AuthController::class, 'check'])->name('login.check');
});
