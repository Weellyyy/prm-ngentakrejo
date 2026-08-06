<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanDonasi extends Model
{
    protected $table = 'laporan_donasi';

    protected $fillable = [
        'nama_donatur',
        'jumlah',
        'tanggal_donasi',
        'program_tujuan',
        'metode_pembayaran',
        'bukti_transfer',
        'catatan',
    ];
}