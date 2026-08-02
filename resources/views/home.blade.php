<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRM Ngentakrejo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <header class="bg-indigo-700 text-white">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <h1 class="text-4xl font-bold">{{ $profil?->nama_organisasi ?? 'PRM Ngentakrejo' }}</h1>
            <p class="mt-4 text-lg max-w-3xl">{{ $profil?->deskripsi ?? 'Profil PRM' }}</p>
            <div class="mt-8 flex gap-4">
                <a href="#profil" class="bg-white text-indigo-700 px-4 py-2 rounded font-semibold">Profil PRM</a>
                <a href="#agenda" class="border border-white px-4 py-2 rounded font-semibold">Agenda</a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-12 space-y-12">
        <section id="profil" class="grid lg:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded shadow lg:col-span-2">
                <h2 class="text-2xl font-semibold">Profil PRM</h2>
                <div class="mt-4 space-y-6 text-gray-600 leading-relaxed">
                    <div>
                        <h3 class="font-semibold text-gray-800">Visi</h3>
                        <p class="mt-2">{{ $profil?->visi ?? 'Mewujudkan PRM yang aktif, mandiri, dan bermanfaat bagi jamaah serta lingkungan sekitar.' }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Misi</h3>
                        <p class="mt-2">{{ $profil?->misi ?? 'Menguatkan dakwah, pendidikan, pelayanan sosial, dan kolaborasi program yang berdampak.' }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Latar Belakang</h3>
                        <p class="mt-2">{{ $profil?->latar_belakang ?? 'PRM hadir untuk menjadi wadah gerakan jamaah yang terstruktur dalam pembinaan, pelayanan, dan pengembangan potensi umat di tingkat ranting.' }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-8 rounded shadow">
                <h2 class="text-2xl font-semibold">Info PRM</h2>
                <div class="mt-4 space-y-4 text-sm text-gray-600">
                    <div>
                        <p class="font-semibold text-gray-800">Alamat</p>
                        <p>{{ $pengaturan['alamat'] ?? $profil?->alamat ?? 'Belum diisi' }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Telepon / WhatsApp</p>
                        <p>{{ $pengaturan['whatsapp'] ?? $profil?->whatsapp ?? $profil?->telepon ?? 'Belum diisi' }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Email</p>
                        <p>{{ $pengaturan['email'] ?? $profil?->email ?? 'Belum diisi' }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Media Sosial</p>
                        <ul class="mt-1 space-y-1">
                            <li>Instagram: {{ $pengaturan['instagram'] ?? $profil?->instagram ?? 'Belum diisi' }}</li>
                            <li>Facebook: {{ $pengaturan['facebook'] ?? $profil?->facebook ?? 'Belum diisi' }}</li>
                            <li>Youtube: {{ $pengaturan['youtube'] ?? $profil?->youtube ?? 'Belum diisi' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white p-8 rounded shadow">
            <h2 class="text-2xl font-semibold">Daftar Pengurus</h2>
            <div class="mt-6 grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($pengurus as $pengurusItem)
                    <div class="border rounded p-4">
                        <h3 class="font-semibold">{{ $pengurusItem->nama }}</h3>
                        <p class="text-sm text-gray-600">{{ $pengurusItem->jabatan }}</p>
                        <p class="text-sm text-gray-500">{{ $pengurusItem->bidang }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada data pengurus.</p>
                @endforelse
            </div>
        </section>

        <section id="agenda" class="bg-white p-8 rounded shadow">
            <h2 class="text-2xl font-semibold">Agenda Kegiatan</h2>
            <div class="mt-6 space-y-4">
                @forelse ($agendas as $agenda)
                    <div class="border-l-4 border-indigo-500 pl-4">
                        <h3 class="font-semibold">{{ $agenda->judul }}</h3>
                        <p class="text-sm text-gray-500">{{ $agenda->tanggal }} • {{ $agenda->waktu }} • {{ $agenda->lokasi }}</p>
                        <p class="mt-2 text-gray-600">{{ $agenda->deskripsi }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada agenda.</p>
                @endforelse
            </div>
        </section>

        <section class="grid md:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded shadow">
                <h2 class="text-2xl font-semibold">Program Kerja</h2>
                <div class="mt-6 space-y-4">
                    @forelse ($programKerja as $program)
                        <div>
                            <h3 class="font-semibold">{{ $program->judul }}</h3>
                            <p class="text-sm text-gray-500">{{ $program->majelis }} • {{ $program->status }}</p>
                            <p class="mt-2 text-gray-600">{{ $program->deskripsi }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada program kerja.</p>
                    @endforelse
                </div>
            </div>
            <div class="bg-white p-8 rounded shadow">
                <h2 class="text-2xl font-semibold">Media Dakwah</h2>
                <div class="mt-6 space-y-4">
                    @forelse ($media as $item)
                        <div>
                            <h3 class="font-semibold">{{ $item->judul }}</h3>
                            <p class="mt-2 text-gray-600">{{ $item->ringkasan }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada media dakwah.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="grid lg:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded shadow">
                <h2 class="text-2xl font-semibold">Ruang Iklan</h2>
                <div class="mt-6 space-y-4">
                    @forelse ($iklan as $item)
                        <div class="rounded border border-gray-200 p-4">
                            <h3 class="font-semibold">{{ $item->nama }}</h3>
                            <p class="text-sm text-gray-500">Kontak: {{ $item->kontak }}</p>
                            <p class="mt-2 text-gray-600">{{ $item->deskripsi ?? 'Informasi iklan belum diisi.' }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada ruang iklan yang aktif.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white p-8 rounded shadow">
                <h2 class="text-2xl font-semibold">Donasi</h2>
                <div class="mt-6 space-y-4 text-gray-600">
                    <div class="rounded border border-gray-200 p-4">
                        <p class="font-semibold text-gray-800">Rekap Donasi {{ $donasi?->periode ?? 'Terakhir' }}</p>
                        <p class="mt-2">Masuk: Rp {{ number_format((float) ($donasi?->masuk ?? 0), 0, ',', '.') }}</p>
                        <p>Keluar: Rp {{ number_format((float) ($donasi?->keluar ?? 0), 0, ',', '.') }}</p>
                        <p class="mt-2">Keterangan: {{ $donasi?->keterangan ?? 'Belum ada catatan donasi.' }}</p>
                    </div>
                    <div class="rounded border border-gray-200 p-4">
                        <p class="font-semibold text-gray-800">Info Donasi</p>
                        <p class="mt-2">Gunakan rekening atau kanal donasi resmi yang ditetapkan PRM untuk mendukung program dakwah dan kegiatan sosial.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
