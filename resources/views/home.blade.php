@extends('layouts.public')

@section('content')
    <header class="relative overflow-hidden text-white min-h-[600px] lg:min-h-[720px] flex items-center">
        <div class="absolute inset-0 bg-cover bg-[position:center_30%]" style="background-image: url('{{ $heroBackground }}');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-950/55 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-16 w-full">
            <div class="max-w-2xl">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-emerald-200">Selamat Datang di</p>
                <h1 class="mt-4 text-4xl lg:text-6xl font-bold leading-tight">{{ $profil?->nama_organisasi ?? 'PRM Ngentakrejo' }}</h1>
                {{--<p class="mt-5 text-lg text-slate-200 leading-relaxed">{{ $profil?->deskripsi ?? 'Ringkasan singkat tentang profil, agenda, program, media dakwah, donasi, dan ruang iklan.' }}</p>--}}
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('login') }}" class="rounded-full bg-[#d9b75f] px-6 py-3 text-sm font-semibold text-emerald-950 shadow-sm shadow-[#d9b75f]/20 transition hover:bg-[#cfac4d]">
                        Login Admin
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-12 space-y-8">

        {{-- Highlight cards, dipindah dari dalam hero --}}
        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 -mt-16 relative z-10">
            @foreach ($highlights as $highlight)
                <a href="{{ route($highlight['route']) }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_18px_40px_rgba(15,23,42,0.08)] transition hover:-translate-y-0.5 hover:border-emerald-700/30 hover:shadow-lg">
                    <p class="text-sm font-semibold text-emerald-700">{{ $highlight['title'] }}</p>
                    <p class="mt-2 text-sm text-slate-500">{{ $highlight['description'] }}</p>
                </a>
            @endforeach
        </section>

        <section class="bg-white rounded-3xl shadow-sm ring-1 ring-slate-200 p-6 lg:p-8">
            <div class="flex items-start justify-between flex-wrap gap-4">
                <div>
                    <h2 class="text-2xl font-semibold text-slate-900">Gambaran Singkat</h2>
                    <p class="mt-2 text-slate-600">Halaman ini hanya menampilkan ringkasan. Detail lengkap tersedia di halaman khusus masing-masing menu.</p>
                </div>
            </div>
            <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700">Profil PRM</p>
                    <h3 class="mt-3 text-lg font-semibold text-slate-900">Visi, misi, dan latar belakang</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ \Illuminate\Support\Str::limit($profil?->deskripsi ?? 'Profil PRM', 120) }}</p>
                    <a href="{{ route('login') }}" class="mt-4 inline-flex text-sm font-semibold text-emerald-700">Buka halaman detail</a>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700">Agenda</p>
                    <h3 class="mt-3 text-lg font-semibold text-slate-900">{{ $agendas->first()?->judul ?? 'Belum ada agenda' }}</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $agendas->first()?->deskripsi ?? 'Jadwal kegiatan akan ditampilkan di halaman agenda.' }}</p>
                    <a href="{{ route('agenda') }}" class="mt-4 inline-flex text-sm font-semibold text-emerald-700">Lihat agenda</a>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700">Informasi PRM</p>
                    <h3 class="mt-3 text-lg font-semibold text-slate-900">Alamat dan media sosial</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $pengaturan['alamat'] ?? $profil?->alamat ?? 'Data informasi belum diisi.' }}</p>
                    <a href="{{ route('informasi-prm') }}" class="mt-4 inline-flex text-sm font-semibold text-emerald-700">Lihat informasi</a>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700">Program Kerja</p>
                    <h3 class="mt-3 text-lg font-semibold text-slate-900">{{ $programKerja->first()?->judul ?? 'Belum ada program' }}</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $programKerja->first()?->deskripsi ?? 'Program kerja akan dipublikasikan di halaman khusus.' }}</p>
                    <a href="{{ route('program-kerja') }}" class="mt-4 inline-flex text-sm font-semibold text-emerald-700">Buka program kerja</a>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700">Media Dakwah</p>
                    <h3 class="mt-3 text-lg font-semibold text-slate-900">{{ $media->first()?->judul ?? 'Belum ada artikel' }}</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $media->first()?->isi ? \Illuminate\Support\Str::limit(strip_tags($media->first()->isi), 120) : 'Konten dakwah terbaru tampil di halaman media dakwah.' }}</p>
                    <a href="{{ route('media-dakwah') }}" class="mt-4 inline-flex text-sm font-semibold text-emerald-700">Lihat media dakwah</a>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700">Donasi</p>
                    <h3 class="mt-3 text-lg font-semibold text-slate-900">Donasi Terbaru</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">Terdapat donasi masuk sebesar Rp {{ number_format((float) ($donasi?->jumlah ?? 0), 0, ',', '.') }} dari {{ $donasi?->nama_donatur ?: 'Hamba Allah' }}.</p>
                    <a href="{{ route('donasi') }}" class="mt-4 inline-flex text-sm font-semibold text-emerald-700">Lihat donasi</a>
                </article>
            </div>
        </section>
    </main>
@endsection