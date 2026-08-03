<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agenda', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('deskripsi');
            $table->string('status')->default('Akan Datang')->after('gambar');
            $table->string('penanggung_jawab')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('agenda', function (Blueprint $table) {
            $table->dropColumn(['gambar', 'status', 'penanggung_jawab']);
        });
    }
};