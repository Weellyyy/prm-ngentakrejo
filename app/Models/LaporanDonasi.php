<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanDonasi extends Model
{
    protected $table = 'laporan_donasi';

    protected $fillable = ['periode', 'masuk', 'keluar', 'keterangan'];
}
