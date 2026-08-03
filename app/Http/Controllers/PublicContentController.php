<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Artikel;
use App\Models\Iklan;
use App\Models\LaporanDonasi;
use App\Models\Pengurus;
use App\Models\Pengaturan;
use App\Models\ProfilPrm;
use App\Models\ProgramKerja;

class PublicContentController extends Controller
{
    private function publicImageUrl(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset('storage/'.$path);
    }

    private function siteData(): array
    {
        $profil = ProfilPrm::where('is_active', true)->latest()->first();
        $pengurus = Pengurus::orderBy('urutan')->get();
        $agendas = Agenda::orderBy('tanggal')->get();
        $programKerja = ProgramKerja::orderBy('created_at', 'desc')->get();
        $media = Artikel::orderBy('tanggal', 'desc')->take(3)->get();
        $iklan = Iklan::orderBy('created_at', 'desc')->take(3)->get();
        $donasi = LaporanDonasi::orderBy('created_at', 'desc')->first();
        $pengaturan = Pengaturan::pluck('value', 'key');

        $heroBackground = $this->publicImageUrl($profil?->hero_background_image)
            ?: 'https://images.unsplash.com/photo-1523162620-3f5c1c9f0fbb?auto=format&fit=crop&w=1600&q=80';

        return compact('profil', 'pengurus', 'agendas', 'programKerja', 'media', 'iklan', 'donasi', 'pengaturan', 'heroBackground');
    }

    public function home()
    {
        $data = $this->siteData();

        return view('home', $data + [
            'pageTitle' => 'PRM Ngentakrejo',
            'pageDescription' => $data['profil']?->deskripsi ?? 'Ringkasan informasi PRM, agenda, program kerja, media dakwah, donasi, dan ruang iklan.',
            'highlights' => [
                ['title' => 'Profil PRM', 'description' => 'Visi, misi, latar belakang, dan daftar pengurus.', 'route' => 'profil-prm'],
                ['title' => 'Agenda Kegiatan', 'description' => 'Jadwal kegiatan rutin dan agenda mendatang.', 'route' => 'agenda'],
                ['title' => 'Informasi PRM', 'description' => 'Alamat, kontak, dan media sosial resmi.', 'route' => 'informasi-prm'],
                ['title' => 'Program Kerja', 'description' => 'Daftar program kerja dan status pelaksanaannya.', 'route' => 'program-kerja'],
                ['title' => 'Media Dakwah', 'description' => 'Artikel dan konten dakwah terbaru.', 'route' => 'media-dakwah'],
                ['title' => 'Ruang Iklan', 'description' => 'Slot promosi untuk usaha dan kegiatan jamaah.', 'route' => 'ruang-iklan'],
                ['title' => 'Donasi', 'description' => 'Ringkasan pemasukan, pengeluaran, dan catatan donasi.', 'route' => 'donasi'],
            ],
        ]);
    }

    public function profilPrm()
    {
        $data = $this->siteData();

        return view('pages.show', $data + [
            'pageTitle' => 'Profil PRM',
            'pageDescription' => 'Visi, misi, latar belakang, dan daftar pengurus PRM.',
            'sections' => [
                [
                    'title' => 'Visi',
                    'type' => 'text',
                    'items' => [$data['profil']?->visi ?? 'Mewujudkan PRM yang aktif, mandiri, dan bermanfaat bagi jamaah serta lingkungan sekitar.'],
                ],
                [
                    'title' => 'Misi',
                    'type' => 'list',
                    'items' => $data['profil']?->misi
                        ? array_values(array_filter(preg_split('/\r\n|\r|\n/', $data['profil']->misi)))
                        : ['Menguatkan dakwah, pendidikan, pelayanan sosial, dan kolaborasi program yang berdampak.'],
                ],
                [
                    'title' => 'Latar Belakang',
                    'type' => 'text',
                    'items' => [$data['profil']?->latar_belakang ?? 'PRM hadir untuk menjadi wadah gerakan jamaah yang terstruktur dalam pembinaan, pelayanan, dan pengembangan potensi umat di tingkat ranting.'],
                    'image' => $this->publicImageUrl($data['profil']?->latar_belakang_image),
                ],
                [
                    'title' => 'Daftar Pengurus',
                    'type' => 'cards',
                    'items' => $data['pengurus']->map(fn ($item) => [
                        'title' => $item->nama,
                        'meta' => $item->jabatan,
                        'periode' => $item->periode_jabatan,
                        'kontak' => $item->kontak,
                        'description' => $item->bio ?? 'Belum ada bio.',
                        'image' => $this->publicImageUrl($item->gambar),
                    ])->all(),
                ],
            ],
        ]);
    }

    public function agenda()
    {
        $data = $this->siteData();

        return view('pages.show', $data + [
            'pageTitle' => 'Agenda Kegiatan',
            'pageDescription' => 'Agenda rutin dan kegiatan PRM yang akan datang.',
            'sections' => [
                [
                    'title' => 'Jadwal Agenda',
                    'type' => 'cards',
                    'items' => $data['agendas']->map(fn ($agenda) => [
                        'title' => $agenda->judul,
                        'meta' => $agenda->tanggal.' • '.$agenda->waktu.' • '.$agenda->lokasi,
                        'description' => $agenda->deskripsi ?? 'Belum ada deskripsi kegiatan.',
                        'image' => $this->publicImageUrl($agenda->gambar),
                        'status' => $agenda->status,
                        'penanggungJawab' => $agenda->penanggung_jawab,
                    ])->all(),
                ],
            ],
        ]);
    }

    public function informasiPrm()
    {
        $data = $this->siteData();

        return view('pages.show', $data + [
            'pageTitle' => 'Informasi PRM',
            'pageDescription' => 'Alamat, kontak, dan kanal media sosial resmi PRM.',
            'sections' => [
                [
                    'title' => 'Kontak Resmi',
                    'type' => 'cards',
                    'items' => [
                        ['title' => 'Alamat', 'meta' => 'Lokasi sekretariat', 'description' => $data['pengaturan']['alamat'] ?? $data['profil']?->alamat ?? 'Belum diisi'],
                        ['title' => 'Telepon / WhatsApp', 'meta' => 'Nomor aktif', 'description' => $data['pengaturan']['whatsapp'] ?? $data['profil']?->whatsapp ?? $data['profil']?->telepon ?? 'Belum diisi'],
                        ['title' => 'Email', 'meta' => 'Surat elektronik', 'description' => $data['pengaturan']['email'] ?? $data['profil']?->email ?? 'Belum diisi'],
                    ],
                ],
                [
                    'title' => 'Media Sosial',
                    'type' => 'cards',
                    'items' => [
                        ['title' => 'Instagram', 'meta' => 'Akun resmi', 'description' => $data['pengaturan']['instagram'] ?? $data['profil']?->instagram ?? 'Belum diisi'],
                        ['title' => 'Facebook', 'meta' => 'Halaman resmi', 'description' => $data['pengaturan']['facebook'] ?? $data['profil']?->facebook ?? 'Belum diisi'],
                        ['title' => 'Youtube', 'meta' => 'Channel resmi', 'description' => $data['pengaturan']['youtube'] ?? $data['profil']?->youtube ?? 'Belum diisi'],
                    ],
                ],
            ],
        ]);
    }

    public function ruangIklan()
    {
        $data = $this->siteData();

        return view('pages.show', $data + [
            'pageTitle' => 'Ruang Iklan',
            'pageDescription' => 'Slot promosi usaha, layanan, dan kegiatan jamaah.',
            'sections' => [
                [
                    'title' => 'Iklan Aktif',
                    'type' => 'cards',
                    'items' => $data['iklan']->map(fn ($item) => [
                        'title' => $item->nama,
                        'meta' => 'Kontak: '.$item->kontak,
                        'description' => $item->deskripsi ?? 'Informasi iklan belum diisi.',
                        'image' => $this->publicImageUrl($item->gambar),
                    ])->all(),
                ],
            ],
        ]);
    }

    public function donasi()
    {
        $data = $this->siteData();

        return view('pages.show', $data + [
            'pageTitle' => 'Donasi',
            'pageDescription' => 'Ringkasan donasi dan informasi dukungan untuk program PRM.',
            'sections' => [
                [
                    'title' => 'Ringkasan Donasi',
                    'type' => 'cards',
                    'items' => [
                        ['title' => 'Periode', 'meta' => 'Laporan terbaru', 'description' => $data['donasi']?->periode ?? 'Belum ada laporan'],
                        ['title' => 'Masuk', 'meta' => 'Total pemasukan', 'description' => 'Rp '.number_format((float) ($data['donasi']?->masuk ?? 0), 0, ',', '.')] ,
                        ['title' => 'Keluar', 'meta' => 'Total pengeluaran', 'description' => 'Rp '.number_format((float) ($data['donasi']?->keluar ?? 0), 0, ',', '.')] ,
                    ],
                ],
                ['title' => 'Keterangan', 'type' => 'text', 'items' => [$data['donasi']?->keterangan ?? 'Belum ada catatan donasi.']],
            ],
        ]);
    }

    public function programKerja()
    {
        $data = $this->siteData();

        return view('pages.show', $data + [
            'pageTitle' => 'Program Kerja',
            'pageDescription' => 'Program kerja PRM dan status pelaksanaannya.',
            'sections' => [
                [
                    'title' => 'Daftar Program',
                    'type' => 'cards',
                    'items' => $data['programKerja']->map(fn ($program) => [
                        'title' => $program->judul,
                        'meta' => $program->majelis.' • '.$program->status,
                        'description' => $program->deskripsi ?? 'Belum ada deskripsi program.',
                    ])->all(),
                ],
            ],
        ]);
    }

    public function mediaDakwah()
    {
        $data = $this->siteData();

        return view('pages.show', $data + [
            'pageTitle' => 'Media Dakwah',
            'pageDescription' => 'Artikel, ringkasan, dan konten dakwah terbaru.',
            'sections' => [
                [
                    'title' => 'Artikel Terbaru',
                    'type' => 'cards',
                    'items' => $data['media']->map(fn ($item) => [
                        'title' => $item->judul,
                        'meta' => $item->tanggal.' • '.$item->penulis,
                        'description' => $item->ringkasan,
                        'image' => $this->publicImageUrl($item->gambar),
                    ])->all(),
                ],
            ],
        ]);
    }
}