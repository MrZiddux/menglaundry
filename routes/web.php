<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\TransaksiController;
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

   Route::get('outlets', [OutletController::class, 'index']);
   Route::get('outlets/getData', [OutletController::class, 'getData']);
   Route::post('outlets/store', [OutletController::class, 'store'])->name('outlets.store');
   Route::post('outlets/update', [OutletController::class, 'update'])->name('outlets.update');
   Route::post('outlets/destroy', [OutletController::class, 'destroy'])->name('outlets.destroy');

   Route::get('packages', [PaketController::class, 'index']);
   Route::get('packages/getData', [PaketController::class, 'getData']);
   Route::post('packages/store', [PaketController::class, 'store'])->name('packages.store');
   Route::post('packages/update', [PaketController::class, 'update'])->name('packages.update');
   Route::post('packages/destroy', [PaketController::class, 'destroy'])->name('packages.destroy');

   Route::view('users', 'pages.users.index');

   Route::view('transactions', 'pages.transaction.index');
   Route::get('transaction/new', [TransaksiController::class, 'showNewTransaction'])->name('transaction.new');
   Route::post('transaction/new/store', [TransaksiController::class, 'store'])->name('transaction.store');
   Route::view('transaction/manage', 'pages.transaction.manage.index');

   Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
   Route::view('login', 'pages.auth.login')->name('login');
   Route::post('login/check', [AuthController::class, 'check'])->name('login.check');
});
