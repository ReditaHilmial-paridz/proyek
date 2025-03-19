<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// Route untuk halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// Route untuk login admin
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin']);

// Route untuk login user
Route::get('/user/login', [AuthController::class, 'showUserLoginForm'])->name('user.login');
Route::post('/user/login', [AuthController::class, 'userLogin']);

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk admin (hanya bisa diakses oleh admin)
Route::middleware('admin')->group(function () {
    Route::get('/admin/akun/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/fasilitas/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/petugas/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/siswa/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/arsip/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('akun', AkunController::class);
    Route::resource('fasilitas', FasilitasController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('arsip', ArsipController::class);
});

// Route untuk user (hanya bisa diakses oleh user)
Route::middleware('user')->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});