<?php

use App\Http\Controllers\Admin\ProfilPrmController;
use App\Http\Controllers\PublicContentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicContentController::class, 'home'])->name('home');
Route::get('/profil-prm', [PublicContentController::class, 'profilPrm'])->name('profil-prm');
Route::get('/agenda', [PublicContentController::class, 'agenda'])->name('agenda');
Route::get('/informasi-prm', [PublicContentController::class, 'informasiPrm'])->name('informasi-prm');
Route::get('/ruang-iklan', [PublicContentController::class, 'ruangIklan'])->name('ruang-iklan');
Route::get('/donasi', [PublicContentController::class, 'donasi'])->name('donasi');
Route::get('/program-kerja', [PublicContentController::class, 'programKerja'])->name('program-kerja');
Route::get('/media-dakwah', [PublicContentController::class, 'mediaDakwah'])->name('media-dakwah');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profil-prm', [ProfilPrmController::class, 'index'])->name('profil-prm.index');
    Route::post('/profil-prm', [ProfilPrmController::class, 'store'])->name('profil-prm.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
