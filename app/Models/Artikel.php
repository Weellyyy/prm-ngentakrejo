<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';

    protected $fillable = ['judul', 'jenis_media', 'penulis', 'tanggal', 'ringkasan', 'isi', 'gambar', 'file_media'];
}
