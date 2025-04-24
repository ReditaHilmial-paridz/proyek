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
use App\Exports\SiswaTemplateExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\SuratKabarController;
use App\Models\Petugas;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin']);
Route::get('/user/login', [AuthController::class, 'showUserLoginForm'])->name('user.login.form');
Route::post('/user/login', [AuthController::class, 'userLogin'])->name('user.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Surat Kabar Routes
Route::get('/surat/create', [SuratKabarController::class, 'create'])->name('surat.create');
Route::post('/surat/store', [SuratKabarController::class, 'store'])->name('surat.store');

// Admin Routes
Route::middleware('admin')->group(function () {
    // Dashboard Routes
    Route::get('/admin/akun/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/fasilitas/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/petugas/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/siswa/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/arsip/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Resource Routes
    Route::resource('akun', AkunController::class);
    Route::resource('fasilitas', FasilitasController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('arsip', ArsipController::class);
    
    // Siswa Routes with customizations
    Route::resource('siswa', SiswaController::class)->except(['show']);
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/template', function () {
        return Excel::download(new SiswaTemplateExport, 'data_siswa.xlsx');
    })->name('siswa.template');

    // Petugas Routes with customizations
    Route::resource('petugas', PetugasController::class)->except(['show']);
    Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');
    Route::get('/petugas/template', function () {
    })->name('petugas.template');
    
    // Surat Kabar Admin Routes
    Route::get('/admin/surat-kabar', [SuratKabarController::class, 'index'])->name('admin.surat-kabar.index');
    Route::delete('/admin/surat-kabar/{id}', [SuratKabarController::class, 'destroy'])->name('admin.surat-kabar.destroy');
    
    // Arsip Routes
    Route::get('/arsip/{id}/edit', [ArsipController::class, 'edit'])->name('arsip.edit');
});

// User Routes
Route::middleware('user')->group(function () {
    // Dashboard
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    
    // Surat Kabar User Routes
    Route::get('/user/surat-kabar', [SuratKabarController::class, 'userIndex'])->name('user.surat-kabar.index');
    Route::get('/user/surat-kabar/create', [SuratKabarController::class, 'create'])->name('user.surat-kabar.create');
    Route::post('/user/surat-kabar/store', [SuratKabarController::class, 'store'])->name('user.surat-kabar.store');
});