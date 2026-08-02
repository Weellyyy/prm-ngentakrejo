<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';

    protected $fillable = ['judul', 'penulis', 'tanggal', 'ringkasan', 'isi', 'gambar'];
}
