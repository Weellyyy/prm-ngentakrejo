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
        Schema::table('artikel', function (Blueprint $table) {
            $table->string('jenis_media')->nullable()->after('judul');
            $table->string('file_media')->nullable()->after('isi');
            $table->string('penulis')->nullable()->change();
            $table->date('tanggal')->nullable()->change();
            $table->text('ringkasan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artikel', function (Blueprint $table) {
            $table->dropColumn(['jenis_media', 'file_media']);
            $table->string('penulis')->nullable(false)->change();
            $table->date('tanggal')->nullable(false)->change();
            $table->text('ringkasan')->nullable(false)->change();
        });
    }
};
