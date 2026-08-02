<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-emerald-700">Admin PRM</p>
                <h2 class="mt-1 font-semibold text-2xl text-slate-900 leading-tight">
                    Dashboard PRM Ngentakrejo
                </h2>
            </div>
            <div class="text-sm text-slate-500">
                Selamat datang, {{ Auth::user()->name }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-3xl bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] ring-1 ring-emerald-900/8 border-t-4 border-emerald-700">
                    <p class="text-sm font-medium text-slate-500">Profil Aktif</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $stats['profil'] }}</p>
                    <p class="mt-2 text-sm text-slate-500">Data profil, visi, dan background beranda.</p>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] ring-1 ring-emerald-900/8 border-t-4 border-[#d9b75f]">
                    <p class="text-sm font-medium text-slate-500">Pengurus</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $stats['pengurus'] }}</p>
                    <p class="mt-2 text-sm text-slate-500">Daftar pimpinan dan majelis.</p>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] ring-1 ring-emerald-900/8 border-t-4 border-emerald-600">
                    <p class="text-sm font-medium text-slate-500">Agenda</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $stats['agenda'] }}</p>
                    <p class="mt-2 text-sm text-slate-500">Kegiatan yang ditampilkan di website.</p>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] ring-1 ring-emerald-900/8 border-t-4 border-[#1e5d46]">
                    <p class="text-sm font-medium text-slate-500">Program Kerja</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $stats['programKerja'] }}</p>
                    <p class="mt-2 text-sm text-slate-500">Rencana dan status program PRM.</p>
                </div>
            </div>

            <div class="grid gap-8 lg:grid-cols-[1.35fr_0.65fr]">
                <div class="space-y-8">
                    <div class="rounded-3xl bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] ring-1 ring-emerald-900/8">
                        <div class="flex items-start justify-between gap-4 flex-wrap">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Pintasan Kelola Konten</p>
                                <h3 class="mt-2 text-xl font-semibold text-slate-900">Masuk ke halaman-halaman penting</h3>
                                <p class="mt-2 text-sm text-slate-500">Perbarui isi website tanpa harus menyentuh kode.</p>
                            </div>
                        </div>

                        <div class="mt-6 grid gap-4 md:grid-cols-2">
                            <a href="{{ route('admin.profil-prm.index') }}" class="rounded-2xl border border-emerald-900/10 bg-[#f8fbf9] p-5 transition hover:border-emerald-700/20 hover:bg-white">
                                <p class="text-sm font-semibold text-emerald-800">Profil PRM</p>
                                <p class="mt-2 text-sm text-slate-600">Ubah visi, misi, latar belakang, dan background hero.</p>
                            </a>
                            <a href="{{ route('home') }}" class="rounded-2xl border border-emerald-900/10 bg-[#f8fbf9] p-5 transition hover:border-emerald-700/20 hover:bg-white">
                                <p class="text-sm font-semibold text-emerald-800">Beranda Publik</p>
                                <p class="mt-2 text-sm text-slate-600">Cek hasil tampilannya di halaman pengunjung.</p>
                            </a>
                            <a href="{{ route('profil-prm') }}" class="rounded-2xl border border-emerald-900/10 bg-[#f8fbf9] p-5 transition hover:border-emerald-700/20 hover:bg-white">
                                <p class="text-sm font-semibold text-emerald-800">Halaman Profil</p>
                                <p class="mt-2 text-sm text-slate-600">Lihat halaman profil yang sudah dipublikasikan.</p>
                            </a>
                            <a href="{{ route('dashboard') }}" class="rounded-2xl border border-emerald-900/10 bg-[#f8fbf9] p-5 transition hover:border-emerald-700/20 hover:bg-white">
                                <p class="text-sm font-semibold text-emerald-800">Dashboard</p>
                                <p class="mt-2 text-sm text-slate-600">Kembali ke ringkasan admin PRM.</p>
                            </a>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] ring-1 ring-emerald-900/8">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Konten Terbaru</p>
                        <div class="mt-6 grid gap-4 md:grid-cols-2">
                            <div class="rounded-2xl bg-[#f8fbf9] p-5">
                                <p class="text-xs uppercase tracking-[0.2em] text-emerald-700">Agenda Terdekat</p>
                                <p class="mt-2 font-semibold text-slate-900">{{ $latestAgenda?->judul ?? 'Belum ada agenda' }}</p>
                                <p class="mt-1 text-sm text-slate-600">{{ $latestAgenda?->tanggal ?? '-' }} • {{ $latestAgenda?->lokasi ?? '-' }}</p>
                            </div>
                            <div class="rounded-2xl bg-[#f8fbf9] p-5">
                                <p class="text-xs uppercase tracking-[0.2em] text-emerald-700">Program Terbaru</p>
                                <p class="mt-2 font-semibold text-slate-900">{{ $latestProgram?->judul ?? 'Belum ada program' }}</p>
                                <p class="mt-1 text-sm text-slate-600">{{ $latestProgram?->status ?? '-' }}</p>
                            </div>
                            <div class="rounded-2xl bg-[#f8fbf9] p-5">
                                <p class="text-xs uppercase tracking-[0.2em] text-emerald-700">Media Dakwah</p>
                                <p class="mt-2 font-semibold text-slate-900">{{ $latestMedia?->judul ?? 'Belum ada artikel' }}</p>
                                <p class="mt-1 text-sm text-slate-600">{{ $latestMedia?->tanggal ?? '-' }}</p>
                            </div>
                            <div class="rounded-2xl bg-[#f8fbf9] p-5">
                                <p class="text-xs uppercase tracking-[0.2em] text-emerald-700">Donasi Terakhir</p>
                                <p class="mt-2 font-semibold text-slate-900">{{ $latestDonasi?->periode ?? 'Belum ada laporan' }}</p>
                                <p class="mt-1 text-sm text-slate-600">Masuk Rp {{ number_format((float) ($latestDonasi?->masuk ?? 0), 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="space-y-6">
                    <div class="rounded-3xl bg-gradient-to-br from-emerald-800 to-emerald-950 p-6 text-white shadow-[0_18px_40px_rgba(15,23,42,0.12)]">
                        <p class="text-sm uppercase tracking-[0.25em] text-[#f1d58a]">Status Website</p>
                        <h3 class="mt-3 text-2xl font-semibold">Panel Admin Aktif</h3>
                        <p class="mt-3 text-sm text-emerald-50/85">Gunakan dashboard ini untuk memperbarui informasi publik tanpa mengubah kode.</p>
                    </div>

                    <div class="rounded-3xl bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] ring-1 ring-emerald-900/8">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Pintasan</p>
                        <div class="mt-4 space-y-3">
                            @foreach ($quickLinks as $link)
                                <a href="{{ isset($link['params']) ? route($link['route'], $link['params']) : route($link['route']) }}" class="block rounded-2xl border border-emerald-900/10 bg-[#f8fbf9] p-4 transition hover:border-emerald-700/20 hover:bg-white">
                                    <p class="font-semibold text-slate-900">{{ $link['label'] }}</p>
                                    <p class="mt-1 text-sm text-slate-600">{{ $link['description'] }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] ring-1 ring-emerald-900/8">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Ringkasan Data</p>
                        <div class="mt-4 space-y-3 text-sm text-slate-600">
                            <p>Pengurus: {{ $stats['pengurus'] }}</p>
                            <p>Agenda: {{ $stats['agenda'] }}</p>
                            <p>Media Dakwah: {{ $stats['media'] }}</p>
                            <p>Iklan: {{ $stats['iklan'] }}</p>
                            <p>Laporan Donasi: {{ $stats['donasi'] }}</p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>