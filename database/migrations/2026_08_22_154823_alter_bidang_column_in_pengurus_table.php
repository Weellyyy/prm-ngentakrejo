<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mengubah dari enum menjadi varchar (string) agar bisa menampung 'Ranting' dsb
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE pengurus MODIFY bidang VARCHAR(255) NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke enum
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE pengurus MODIFY bidang ENUM('Pimpinan', 'Majelis') NOT NULL");
    }
};
