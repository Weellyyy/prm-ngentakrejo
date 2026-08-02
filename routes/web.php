<?php

use App\Http\Controllers\Admin\ProfilPrmController;
use App\Http\Controllers\ProfileController;
use App\Models\Agenda;
use App\Models\Artikel;
use App\Models\Iklan;
use App\Models\LaporanDonasi;
use App\Models\Pengurus;
use App\Models\Pengaturan;
use App\Models\ProfilPrm;
use App\Models\ProgramKerja;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $profil = ProfilPrm::where('is_active', true)->latest()->first();
    $pengurus = Pengurus::orderBy('urutan')->get();
    $agendas = Agenda::orderBy('tanggal')->get();
    $programKerja = ProgramKerja::orderBy('created_at', 'desc')->get();
    $media = Artikel::orderBy('tanggal', 'desc')->take(3)->get();
    $iklan = Iklan::orderBy('created_at', 'desc')->take(3)->get();
    $donasi = LaporanDonasi::orderBy('created_at', 'desc')->first();
    $pengaturan = Pengaturan::pluck('value', 'key');

    return view('home', compact('profil', 'pengurus', 'agendas', 'programKerja', 'media', 'iklan', 'donasi', 'pengaturan'));
});

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
