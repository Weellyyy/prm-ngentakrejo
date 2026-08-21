<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Pimpinan', 'Majelis'] as $nama) {
            Bidang::firstOrCreate(['nama' => $nama]);
        }
    }
}