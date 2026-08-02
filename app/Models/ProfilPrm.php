<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPrm extends Model
{
    protected $table = 'profil_prm';

    protected $fillable = [
        'nama_organisasi',
        'visi',
        'misi',
        'latar_belakang',
        'deskripsi',
        'alamat',
        'telepon',
        'email',
        'instagram',
        'facebook',
        'youtube',
        'whatsapp',
        'is_active',
    ];
}
