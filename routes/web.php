<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'pages.home.index');
Route::get('members', [MemberController::class, 'index']);
Route::get('members/getData', [MemberController::class, 'getData']);
Route::post('members/store', [MemberController::class, 'store'])->name('members.store');
Route::post('members/update', [MemberController::class, 'update'])->name('members.update');
Route::post('members/destroy', [MemberController::class, 'destroy'])->name('members.destroy');

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

// Route::view('register', 'page.auth.register');
// Route::post('register/store', [AuthController::class, 'store'])->name('register.store');
// Route::post('register/checkUsername', [AuthController::class, 'checkUsername'])->name('register.checkUsername');
Route::view('login', 'pages.auth.login')->name('login');
Route::post('login/check', [AuthController::class, 'check'])->name('login.check');
