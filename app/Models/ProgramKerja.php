<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    protected $table = 'program_kerja';

    protected $fillable = ['judul', 'majelis', 'status', 'deskripsi'];

}
