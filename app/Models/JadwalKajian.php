<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKajian extends Model
{
    protected $table = 'jadwal_kajian';

    protected $fillable = ['hari', 'kegiatan'];
}
