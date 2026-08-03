<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->string('periode_jabatan')->nullable()->after('jabatan');
            $table->string('kontak')->nullable()->after('periode_jabatan');
            $table->text('bio')->nullable()->after('kontak');
        });

        Schema::table('profil_prm', function (Blueprint $table) {
            $table->string('latar_belakang_image')->nullable()->after('latar_belakang');
        });
    }

    public function down(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->dropColumn(['periode_jabatan', 'kontak', 'bio']);
        });

        Schema::table('profil_prm', function (Blueprint $table) {
            $table->dropColumn('latar_belakang_image');
        });
    }
};