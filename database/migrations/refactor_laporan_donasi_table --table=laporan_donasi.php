<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporan_donasi', function (Blueprint $table) {
            foreach (['periode', 'masuk', 'keluar', 'keterangan'] as $column) {
                if (Schema::hasColumn('laporan_donasi', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('laporan_donasi', function (Blueprint $table) {
            if (!Schema::hasColumn('laporan_donasi', 'nama_donatur')) {
                $table->string('nama_donatur')->nullable()->after('id');
            }
            if (!Schema::hasColumn('laporan_donasi', 'jumlah')) {
                $table->decimal('jumlah', 15, 2)->nullable()->after('nama_donatur');
            }
            if (!Schema::hasColumn('laporan_donasi', 'tanggal_donasi')) {
                $table->date('tanggal_donasi')->nullable()->after('jumlah');
            }
            if (!Schema::hasColumn('laporan_donasi', 'program_tujuan')) {
                $table->string('program_tujuan')->nullable()->after('tanggal_donasi');
            }
            if (!Schema::hasColumn('laporan_donasi', 'metode_pembayaran')) {
                $table->string('metode_pembayaran')->nullable()->after('program_tujuan');
            }
            if (!Schema::hasColumn('laporan_donasi', 'bukti_transfer')) {
                $table->string('bukti_transfer')->nullable()->after('metode_pembayaran');
            }
            if (!Schema::hasColumn('laporan_donasi', 'catatan')) {
                $table->text('catatan')->nullable()->after('bukti_transfer');
            }
        });
    }

    public function down(): void
    {
        Schema::table('laporan_donasi', function (Blueprint $table) {
            $table->dropColumn([
                'nama_donatur', 'jumlah', 'tanggal_donasi',
                'program_tujuan', 'metode_pembayaran', 'bukti_transfer', 'catatan',
            ]);

            $table->string('periode')->nullable();
            $table->decimal('masuk', 15, 2)->nullable();
            $table->decimal('keluar', 15, 2)->nullable();
            $table->text('keterangan')->nullable();
        });
    }
};