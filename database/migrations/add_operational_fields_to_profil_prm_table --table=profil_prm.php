<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_prm', function (Blueprint $table) {
            $table->string('tiktok')->nullable()->after('youtube');
            $table->string('jam_operasional')->nullable()->after('tiktok');
            $table->text('google_maps_embed')->nullable()->after('jam_operasional');
        });
    }

    public function down(): void
    {
        Schema::table('profil_prm', function (Blueprint $table) {
            $table->dropColumn(['tiktok', 'jam_operasional', 'google_maps_embed']);
        });
    }
};