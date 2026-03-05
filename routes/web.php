<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\SiswaMiddleware;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;



// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/', [AuthController::class, 'home'])->name('home');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/register/success', [RegisterController::class, 'showSuccessPage'])->name('register.success');


// Siswa Routes (KHUSUS SISWA)
Route::middleware(['auth', SiswaMiddleware::class])
    ->prefix('siswa')
    ->group(function () {
        Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
        Route::get('/form', [SiswaController::class, 'form'])->name('siswa.form');
        Route::post('/store', [SiswaController::class, 'store'])->name('siswa.store');
        Route::get('/riwayat', [SiswaController::class, 'history'])->name('siswa.history');
        Route::get('/riwayat/{id}', [SiswaController::class, 'show'])->name('pengaduan.show');
    });

// Admin Routes (KHUSUS ADMIN)
Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/pengaduan/{id}', [AdminController::class, 'detail'])->name('admin.detail');
        Route::get('/pengaduan', [AdminController::class, 'dashboard'])->name('admin.pengaduan.index');
        Route::post('/status/{id}', [AdminController::class, 'updateStatus'])->name('admin.status');
        Route::post('/respon', [AdminController::class, 'storeRespon'])->name('admin.respon');
        // User management
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/pending', [UserController::class, 'pending'])->name('admin.users.pending');
        Route::post('/users/{user}/approve', [UserController::class, 'approve'])->name('admin.users.approve');
        Route::post('/users/{user}/reject', [UserController::class, 'reject'])->name('admin.users.reject');
        // Kategori management
        Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('admin.kategori.create');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
        Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');
        Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
        Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('admin.kategori.update');
        Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('admin.kategori.detail');

    });
