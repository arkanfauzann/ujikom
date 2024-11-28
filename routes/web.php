<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\FotoController;
use App\Http\Controllers\Admin\GaleryController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\HomeController;

// Frontend Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/informasi', [HomeController::class, 'informasi'])->name('informasi');
Route::get('/agenda', [HomeController::class, 'agenda'])->name('agenda');

Route::get('/program-keahlian', function () {
    return view('program-keahlian');
});

Route::get('/profil', function () {
    return view('profil');
});

// Admin Routes (tanpa middleware sementara)
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Resource Routes
    Route::resources([
        'posts' => PostController::class,
        'kategori' => KategoriController::class,
        'profile' => ProfileController::class,
        'foto' => FotoController::class,
        'galeri' => GaleryController::class,
        'petugas' => PetugasController::class,
        'informasi' => InformasiController::class,
        'agenda' => AgendaController::class,
    ]);

    // Web Preview Route
    Route::get('/web-preview', function () {
        return view('admin.webpreview');
    })->name('web-preview');
});
