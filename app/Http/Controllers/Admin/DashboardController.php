<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Artikel;
use App\Models\Iklan;
use App\Models\LaporanDonasi;
use App\Models\Pengurus;
use App\Models\ProfilPrm;
use App\Models\ProgramKerja;

class DashboardController extends Controller
{
    public function index()
    {
        $profil = ProfilPrm::latest()->first();

        $stats = [
            'profil' => ProfilPrm::count(),
            'pengurus' => Pengurus::count(),
            'agenda' => Agenda::count(),
            'programKerja' => ProgramKerja::count(),
            'media' => Artikel::count(),
            'iklan' => Iklan::count(),
            'donasi' => LaporanDonasi::count(),
        ];

        $latestAgenda = Agenda::orderBy('tanggal')->first();
        $latestProgram = ProgramKerja::orderBy('created_at', 'desc')->first();
        $latestMedia = Artikel::orderBy('tanggal', 'desc')->first();
        $latestDonasi = LaporanDonasi::orderBy('created_at', 'desc')->first();

        $quickLinks = [
            ['label' => 'Kelola Profil PRM', 'route' => 'admin.profil-prm.index', 'description' => 'Update visi, misi, latar belakang, dan background beranda.'],
            ['label' => 'Kelola Pengurus', 'route' => 'admin.content.index', 'params' => ['type' => 'pengurus'], 'description' => 'Tambah dan ubah daftar pengurus PRM.'],
            ['label' => 'Kelola Agenda', 'route' => 'admin.content.index', 'params' => ['type' => 'agenda'], 'description' => 'Atur agenda kegiatan dan jadwal rutin.'],
            ['label' => 'Kelola Program Kerja', 'route' => 'admin.content.index', 'params' => ['type' => 'program-kerja'], 'description' => 'Atur status dan deskripsi program kerja.'],
            ['label' => 'Kelola Media Dakwah', 'route' => 'admin.content.index', 'params' => ['type' => 'media-dakwah'], 'description' => 'Publikasikan artikel dakwah dan ringkasannya.'],
            ['label' => 'Kelola Ruang Iklan', 'route' => 'admin.content.index', 'params' => ['type' => 'ruang-iklan'], 'description' => 'Tambahkan slot promosi dan iklan jamaah.'],
            ['label' => 'Kelola Donasi', 'route' => 'admin.content.index', 'params' => ['type' => 'donasi'], 'description' => 'Catat laporan pemasukan dan pengeluaran.'],
            ['label' => 'Lihat Beranda Publik', 'route' => 'home', 'description' => 'Cek tampilan website yang terlihat pengunjung.'],
            ['label' => 'Kelola Halaman Login', 'route' => 'login', 'description' => 'Masuk ulang atau cek akses akun admin.'],
        ];

        return view('dashboard', compact(
            'profil',
            'stats',
            'latestAgenda',
            'latestProgram',
            'latestMedia',
            'latestDonasi',
            'quickLinks'
        ));
    }
}