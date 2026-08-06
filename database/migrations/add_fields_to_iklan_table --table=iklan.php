<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('iklan', function (Blueprint $table) {
            $table->string('link_url')->nullable()->after('gambar');
            $table->date('tanggal_mulai')->nullable()->after('link_url');
            $table->string('status')->default('Aktif')->after('tanggal_expired');
        });
    }

    public function down(): void
    {
        Schema::table('iklan', function (Blueprint $table) {
            $table->dropColumn(['link_url', 'tanggal_mulai', 'status']);
        });
    }
};