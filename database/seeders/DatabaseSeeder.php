<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Artikel;
use App\Models\Iklan;
use App\Models\LaporanDonasi;
use App\Models\Pengaturan;
use App\Models\Pengurus;
use App\Models\ProfilPrm;
use App\Models\ProgramKerja;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        $profil = ProfilPrm::updateOrCreate(
            ['nama_organisasi' => 'PRM Ngentakrejo'],
            [
                'visi' => 'Mewujudkan PRM yang aktif, mandiri, dan menjadi pusat gerakan dakwah yang bermanfaat bagi jamaah dan masyarakat.',
                'misi' => 'Menguatkan pembinaan jamaah, dakwah bil-hal, pelayanan sosial, pendidikan, dan sinergi program yang berkelanjutan.',
                'latar_belakang' => 'PRM Ngentakrejo dibentuk sebagai wadah gerakan dakwah tingkat ranting yang dekat dengan jamaah, responsif terhadap kebutuhan umat, dan konsisten dalam pelayanan sosial keagamaan.',
                'deskripsi' => 'Profil PRM, agenda kegiatan, program kerja, media dakwah, dan informasi layanan jamaah.',
                'alamat' => 'Ngentakrejo, Kecamatan Sumberlawang, Kabupaten Sragen',
                'telepon' => '0812-3456-7890',
                'email' => 'prmngentakrejo@gmail.com',
                'instagram' => '@prmngentakrejo',
                'facebook' => 'PRM Ngentakrejo',
                'youtube' => 'PRM Ngentakrejo TV',
                'whatsapp' => '0812-3456-7890',
                'hero_background_image' => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=1600&q=80',
                'is_active' => true,
            ]
        );

        Pengaturan::updateOrCreate(['key' => 'alamat'], ['value' => 'Ngentakrejo, Kecamatan Sumberlawang, Kabupaten Sragen']);
        Pengaturan::updateOrCreate(['key' => 'email'], ['value' => 'prmngentakrejo@gmail.com']);
        Pengaturan::updateOrCreate(['key' => 'whatsapp'], ['value' => '0812-3456-7890']);
        Pengaturan::updateOrCreate(['key' => 'instagram'], ['value' => '@prmngentakrejo']);
        Pengaturan::updateOrCreate(['key' => 'facebook'], ['value' => 'PRM Ngentakrejo']);
        Pengaturan::updateOrCreate(['key' => 'youtube'], ['value' => 'PRM Ngentakrejo TV']);

        Pengurus::updateOrCreate(
            ['nama' => 'Ahmad Fauzi'],
            ['jabatan' => 'Ketua PRM', 'bidang' => 'Pimpinan', 'urutan' => 1]
        );
        Pengurus::updateOrCreate(
            ['nama' => 'Siti Aminah'],
            ['jabatan' => 'Sekretaris', 'bidang' => 'Pimpinan', 'urutan' => 2]
        );
        Pengurus::updateOrCreate(
            ['nama' => 'Hadi Santoso'],
            ['jabatan' => 'Bendahara', 'bidang' => 'Pimpinan', 'urutan' => 3]
        );
        Pengurus::updateOrCreate(
            ['nama' => 'Nurul Hidayah'],
            ['jabatan' => 'Koordinator Dakwah', 'bidang' => 'Majelis', 'urutan' => 4]
        );

        Agenda::updateOrCreate(
            ['judul' => 'Pengajian Ahad Pagi'],
            [
                'tanggal' => now()->addDays(3)->toDateString(),
                'waktu' => '07:00:00',
                'lokasi' => 'Masjid setempat',
                'deskripsi' => 'Kajian rutin untuk jamaah bersama ustaz dan pengurus PRM.',
            ]
        );
        Agenda::updateOrCreate(
            ['judul' => 'Rapat Program Kerja'],
            [
                'tanggal' => now()->addDays(7)->toDateString(),
                'waktu' => '19:30:00',
                'lokasi' => 'Sekretariat PRM',
                'deskripsi' => 'Pembahasan agenda bulanan, evaluasi kegiatan, dan koordinasi majelis.',
            ]
        );

        ProgramKerja::updateOrCreate(
            ['judul' => 'Pembinaan Jamaah Rutin'],
            [
                'majelis' => 'Tabligh dan Dakwah',
                'status' => 'Berjalan',
                'deskripsi' => 'Mengadakan kajian, pengajian, dan pembinaan ibadah secara berkala.',
            ]
        );
        ProgramKerja::updateOrCreate(
            ['judul' => 'Santunan Sosial'],
            [
                'majelis' => 'Kesejahteraan',
                'status' => 'Direncanakan',
                'deskripsi' => 'Menyalurkan bantuan kepada jamaah yang membutuhkan melalui pendataan dan donasi.',
            ]
        );
        ProgramKerja::updateOrCreate(
            ['judul' => 'Digitalisasi Informasi PRM'],
            [
                'majelis' => 'Media dan Informasi',
                'status' => 'Berjalan',
                'deskripsi' => 'Memperbarui informasi kegiatan, profil, dan dokumentasi melalui website dan media sosial.',
            ]
        );

        Artikel::updateOrCreate(
            ['judul' => 'Semangat Dakwah Jamaah di Tingkat Ranting'],
            [
                'penulis' => 'Tim Media PRM',
                'tanggal' => now()->subDays(2)->toDateString(),
                'ringkasan' => 'Gerakan dakwah di tingkat ranting menjadi ruang penting untuk memperkuat ukhuwah dan pelayanan umat.',
                'isi' => 'PRM berperan sebagai pusat informasi, pembinaan, dan koordinasi kegiatan dakwah yang dekat dengan jamaah.',
            ]
        );
        Artikel::updateOrCreate(
            ['judul' => 'Program Sosial untuk Jamaah dan Warga'],
            [
                'penulis' => 'Tim Media PRM',
                'tanggal' => now()->subDays(5)->toDateString(),
                'ringkasan' => 'Kegiatan sosial menjadi bagian dari dakwah yang memberi manfaat langsung bagi masyarakat.',
                'isi' => 'Melalui program santunan, kerja bakti, dan layanan umat, PRM hadir lebih dekat dengan kebutuhan warga.',
            ]
        );

        Iklan::updateOrCreate(
            ['nama' => 'Ruang Iklan UMKM Jamaah'],
            [
                'kontak' => '0812-9999-1111',
                'deskripsi' => 'Promosikan usaha jamaah di ruang iklan PRM untuk menjangkau lebih banyak pembaca.',
                'tanggal_expired' => now()->addMonths(1)->toDateString(),
            ]
        );

        LaporanDonasi::updateOrCreate(
            ['periode' => 'Agustus 2026'],
            [
                'masuk' => 12500000,
                'keluar' => 8450000,
                'keterangan' => 'Dana dipakai untuk kegiatan dakwah, santunan, dan operasional pelayanan jamaah.',
            ]
        );
    }
}
