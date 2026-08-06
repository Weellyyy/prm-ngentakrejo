@extends('layouts.public')

@section('content')
    <header class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-[#1e5d46] text-white">
        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-20">
            <p class="text-sm uppercase tracking-[0.3em] text-[#f1d58a]">PRM Ngentakrejo</p>
            <h1 class="mt-4 max-w-3xl text-4xl lg:text-5xl font-bold leading-tight">{{ $pageTitle }}</h1>
            <p class="mt-4 max-w-3xl text-lg text-emerald-50/85">{{ $pageDescription }}</p>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-6 py-12">
        @if (session('success'))
            <div class="mb-6 flex items-center gap-3 rounded-2xl border border-[#d9b75f]/30 bg-[#fffaf0] p-4 text-emerald-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-red-700">
                <p class="text-sm font-medium">Periksa kembali isian berikut:</p>
                <ul class="mt-1.5 list-disc pl-5 text-sm space-y-0.5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="rounded-3xl border border-emerald-900/8 bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] lg:p-8">
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Form Donasi</p>
            <h3 class="mt-2 text-xl font-semibold text-slate-900">Konfirmasi donasi Anda</h3>
            <p class="mt-2 text-sm text-slate-500">Nama boleh dikosongkan jika ingin tercatat sebagai "Hamba Allah".</p>

            <form method="POST" action="{{ route('donasi.store') }}" enctype="multipart/form-data" class="mt-6 space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Nama donatur (opsional)</label>
                    <input type="text" name="nama_donatur" placeholder="Kosongkan jika ingin anonim"
                        class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700"
                        value="{{ old('nama_donatur') }}">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Jumlah donasi (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah" min="1000" step="1000" required
                            class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700"
                            value="{{ old('jumlah') }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Tanggal donasi <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_donasi" required
                            class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700"
                            value="{{ old('tanggal_donasi', now()->toDateString()) }}">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Program/tujuan donasi</label>
                    <input type="text" name="program_tujuan" placeholder="Misal: Pembangunan Masjid, Santunan Yatim"
                        class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700"
                        value="{{ old('program_tujuan') }}">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Metode pembayaran <span class="text-red-500">*</span></label>
                    <input type="text" name="metode_pembayaran" placeholder="Misal: Transfer BCA, QRIS, Tunai" required
                        class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700"
                        value="{{ old('metode_pembayaran') }}">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Bukti transfer (opsional)</label>
                    <input type="file" name="bukti_transfer" accept="image/*"
                        class="mt-1.5 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-xs file:font-medium file:text-emerald-800 hover:file:bg-emerald-100">
                    <p class="mt-1.5 text-xs text-slate-400">Bukti ini hanya untuk verifikasi admin, tidak ditampilkan ke publik.</p>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Catatan/doa (opsional)</label>
                    <textarea name="catatan" rows="3" placeholder="Bismillah, semoga bermanfaat..."
                        class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700">{{ old('catatan') }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-2 border-t border-slate-100">
                    <button type="submit" class="rounded-full bg-emerald-700 px-6 py-3 text-sm font-medium text-white shadow-sm shadow-emerald-700/15 transition hover:bg-emerald-800">
                        Kirim donasi
                    </button>
                    <a href="{{ route('donasi') }}" class="text-sm font-medium text-slate-500 hover:text-slate-700">Batal, kembali ke daftar donasi</a>
                </div>
            </form>
        </div>
    </main>
@endsection