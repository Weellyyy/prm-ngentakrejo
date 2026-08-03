<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';

    protected $fillable = ['judul', 'tanggal', 'waktu', 'lokasi', 'deskripsi', 'gambar',
    'status',
    'penanggung_jawab',];
}
