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
use Illuminate\Http\Request;

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
        return \Illuminate\Support\Facades\Cache::remember('public_site_data', 300, function () {
            $profil = ProfilPrm::where('is_active', true)->latest()->first();
            $pengurus = Pengurus::orderBy('urutan')->get();
            $agendas = Agenda::orderBy('tanggal', 'desc')->take(20)->get();
            $programKerja = ProgramKerja::orderBy('created_at', 'desc')->take(20)->get();
            $media = Artikel::orderBy('created_at', 'desc')->take(3)->get();
            $iklan = Iklan::orderBy('created_at', 'desc')->take(3)->get();
            $donasi = LaporanDonasi::orderBy('created_at', 'desc')->first();
            $pengaturan = Pengaturan::pluck('value', 'key');

            $heroBackground = $this->publicImageUrl($profil?->hero_background_image)
                ?: 'https://images.unsplash.com/photo-1523162620-3f5c1c9f0fbb?auto=format&fit=crop&w=1600&q=80';

            return compact('profil', 'pengurus', 'agendas', 'programKerja', 'media', 'iklan', 'donasi', 'pengaturan', 'heroBackground');
        });
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
                        'bidang' => $item->bidang,
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
                        ['title' => 'Jam Operasional', 'meta' => 'Jadwal kantor', 'description' => $data['pengaturan']['jam_operasional'] ?? $data['profil']?->jam_operasional ?? 'Belum diisi'],
                    ],
                ],
                [
                'title' => 'Media Sosial',
                'type' => 'cards',
                'items' => [
                    [
                        'title' => 'Instagram',
                        'meta' => 'Akun resmi',
                        'description' => $data['pengaturan']['instagram'] ?? $data['profil']?->instagram ?? 'Belum diisi',
                        'linkUrl' => 'https://www.instagram.com/prmngentakrejo/',
                    ],
                    [
                        'title' => 'Facebook',
                        'meta' => 'Halaman resmi',
                        'description' => $data['pengaturan']['facebook'] ?? $data['profil']?->facebook ?? 'Belum diisi',
                        'linkUrl' => 'https://www.facebook.com/prmngentakrejo/',
                    ],
                    [
                        'title' => 'Youtube',
                        'meta' => 'Channel resmi',
                        'description' => $data['pengaturan']['youtube'] ?? $data['profil']?->youtube ?? 'Belum diisi',
                        'linkUrl' => 'https://www.youtube.com/@prm_ngentakrejo',
                    ],
                    [
                        'title' => 'TikTok',
                        'meta' => 'Akun resmi',
                        'description' => $data['pengaturan']['tiktok'] ?? $data['profil']?->tiktok ?? 'Belum diisi',
                        'linkUrl' => 'https://www.tiktok.com/@prmngentakrejo',
                    ],
                ],
            ],
                [
                    'title' => 'Titik Lokasi',
                    'type' => 'map',
                    'embedUrl' => $data['pengaturan']['google_maps_embed'] ?? $data['profil']?->google_maps_embed,
                ],
            ],
        ]);
    }

    public function ruangIklan()
    {
        $data = $this->siteData();

        $today = now()->toDateString();

        $iklanAktif = \App\Models\Iklan::where('status', 'Aktif')
            ->where(function ($q) use ($today) {
                $q->whereNull('tanggal_mulai')->orWhere('tanggal_mulai', '<=', $today);
            })
            ->where(function ($q) use ($today) {
                $q->whereNull('tanggal_expired')->orWhere('tanggal_expired', '>=', $today);
            })
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('pages.show', $data + [
            'pageTitle' => 'Ruang Iklan',
            'pageDescription' => 'Slot promosi usaha, layanan, dan kegiatan jamaah.',
            'sections' => [
                [
                    'title' => 'Iklan Aktif',
                    'type' => 'cards',
                    'items' => $iklanAktif->map(fn ($item) => [
                        'title' => $item->nama,
                        'meta' => 'Kontak: '.$item->kontak,
                        'description' => $item->deskripsi ?? 'Informasi iklan belum diisi.',
                        'image' => $this->publicImageUrl($item->gambar),
                        'linkUrl' => $item->link_url,
                    ])->all(),
                ],
            ],
        ]);
    }

    public function donasi()
    {
        $data = $this->siteData();

        $donasiList = \App\Models\LaporanDonasi::orderBy('tanggal_donasi', 'desc')
            ->take(10)
            ->get();

        return view('pages.show', $data + [
            'pageTitle' => 'Donasi',
            'pageDescription' => 'Catatan donasi dan dukungan jamaah untuk program PRM.',
            'sections' => [
                [
                    'title' => 'Donasi Terbaru',
                    'type' => 'cards',
                    'items' => $donasiList->map(fn ($item) => [
                        'title' => $item->nama_donatur ?: 'Hamba Allah',
                        'meta' => \Illuminate\Support\Carbon::parse($item->tanggal_donasi)->translatedFormat('d F Y').($item->program_tujuan ? ' • '.$item->program_tujuan : ''),
                        'description' => $item->catatan ?? 'Tidak ada catatan.',
                        'jumlah' => 'Rp '.number_format((float) $item->jumlah, 0, ',', '.'),
                        'metode' => $item->metode_pembayaran,
                    ])->all(),
                ],
            ],
        ]);
    }

    public function donasiForm()
    {
        return view('donasi.create', [
            'pageTitle' => 'Kirim Donasi',
            'pageDescription' => 'Isi form berikut untuk mencatat donasi Anda. Admin akan memverifikasi setelah dana diterima.',
        ]);
    }

    public function donasiStore(Request $request)
    {
        $data = $request->validate([
            'nama_donatur' => ['nullable', 'string', 'max:255'],
            'jumlah' => ['required', 'numeric', 'min:1000'],
            'tanggal_donasi' => ['required', 'date'],
            'program_tujuan' => ['nullable', 'string', 'max:255'],
            'metode_pembayaran' => ['required', 'string', 'max:255'],
            'bukti_transfer' => ['nullable', 'image', 'max:2048'],
            'catatan' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('bukti_transfer')) {
            $data['bukti_transfer'] = $request->file('bukti_transfer')->store('donasi', 'public');
        }

        \App\Models\LaporanDonasi::create($data);

        return redirect()->route('donasi')->with('success', 'Terima kasih, donasi Anda berhasil dicatat dan akan segera diverifikasi admin.');
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
        $semuaMedia = \App\Models\Artikel::orderBy('created_at', 'desc')->paginate(12);

        $semuaMedia->getCollection()->transform(function ($item) {
            return [
                'title' => $item->judul,
                'date' => $item->created_at->translatedFormat('d F Y'),
                'jenis_media' => $item->jenis_media,
                'isi' => $item->isi,
                'file_media' => $this->publicImageUrl($item->file_media),
                'gambar' => $this->publicImageUrl($item->gambar),
            ];
        });

        return view('pages.media-dakwah', $data + [
            'pageTitle' => 'Media Dakwah',
            'pageDescription' => 'Artikel, ringkasan, dan konten dakwah terbaru.',
            'items' => $semuaMedia,
        ]);
    }
}