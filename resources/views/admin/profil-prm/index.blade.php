<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-emerald-700">Profil PRM</p>
                <h2 class="mt-1 font-semibold text-2xl text-slate-900 leading-tight">
                    Atur Identitas dan Hero Website
                </h2>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-full border border-emerald-900/10 bg-white px-4 py-2 text-sm font-medium text-emerald-800 transition hover:border-emerald-700 hover:bg-[#f8fbf9]">Kembali ke Dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            <form method="POST" action="{{ route('admin.profil-prm.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr] items-start">
                    <div class="space-y-6">

                        {{-- ================= IDENTITAS & NARASI ================= --}}
                        <div class="rounded-3xl border border-emerald-900/8 bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] lg:p-8">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold text-slate-900">Identitas & narasi</h3>
                                    <p class="text-sm text-slate-500">Nama organisasi, visi, misi, dan latar belakang.</p>
                                </div>
                            </div>

                            <div class="mt-6 space-y-5">
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Nama organisasi</label>
                                    <input type="text" name="nama_organisasi" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('nama_organisasi', $profil->nama_organisasi ?? '') }}">
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Visi</label>
                                    <textarea name="visi" rows="3" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700">{{ old('visi', $profil->visi ?? '') }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Misi</label>
                                    <textarea name="misi" rows="3" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700">{{ old('misi', $profil->misi ?? '') }}</textarea>
                                    <p class="mt-1.5 text-xs text-slate-400">Tulis satu misi per baris (tekan Enter untuk poin baru).</p>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Latar belakang</label>
                                    <textarea name="latar_belakang" rows="4" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700">{{ old('latar_belakang', $profil->latar_belakang ?? '') }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Gambar pendukung latar belakang</label>
                                    @if (!empty($profil->latar_belakang_image))
                                        @php
                                            $latarBelakangPreview = $profil->latar_belakang_image;
                                            $latarBelakangPreview = str_starts_with($latarBelakangPreview, 'http://') || str_starts_with($latarBelakangPreview, 'https://')
                                                ? $latarBelakangPreview
                                                : asset('storage/' . $latarBelakangPreview);
                                        @endphp
                                        <div class="mt-2 mb-2">
                                            <img src="{{ $latarBelakangPreview }}" alt="Gambar Latar Belakang" class="h-36 w-full rounded-xl object-cover border border-slate-200">
                                        </div>
                                        <label class="mb-2 flex items-center gap-2 text-xs text-slate-500">
                                            <input type="checkbox" name="remove_latar_belakang_image" value="1" class="rounded border-slate-300 text-red-600 focus:ring-red-500">
                                            Hapus gambar lama saat simpan
                                        </label>
                                    @endif
                                    <input type="file" name="latar_belakang_image" accept="image/*" class="mt-1 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-xs file:font-medium file:text-emerald-800 hover:file:bg-emerald-100">
                                    <p class="mt-1.5 text-xs text-slate-400">Opsional. Mendukung narasi latar belakang/sejarah PRM.</p>
                                </div>
                            </div>
                        </div>

                        {{-- ================= KONTAK & LOKASI ================= --}}
                        <div class="rounded-3xl border border-emerald-900/8 bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] lg:p-8">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold text-slate-900">Kontak & lokasi</h3>
                                    <p class="text-sm text-slate-500">Alamat, jam operasional, dan peta lokasi.</p>
                                </div>
                            </div>

                            <div class="mt-6 space-y-5">
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Alamat</label>
                                    <textarea name="alamat" rows="2" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Telepon</label>
                                        <input type="text" name="telepon" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('telepon', $profil->telepon ?? '') }}">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Email</label>
                                        <input type="email" name="email" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('email', $profil->email ?? '') }}">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Jam operasional kantor</label>
                                    <input type="text" name="jam_operasional" placeholder="Senin–Jumat, 08.00–16.00 WIB" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('jam_operasional', $profil->jam_operasional ?? '') }}">
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Link embed Google Maps</label>
                                    <input type="url" name="google_maps_embed" placeholder="https://www.google.com/maps/embed?pb=..." class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('google_maps_embed', $profil->google_maps_embed ?? '') }}">
                                    <p class="mt-1.5 text-xs text-slate-400">Buka Google Maps → Bagikan → Sematkan peta → salin URL di dalam <code class="rounded bg-slate-100 px-1 py-0.5">src="..."</code>, lalu tempel di sini.</p>
                                </div>
                            </div>
                        </div>

                        {{-- ================= MEDIA SOSIAL ================= --}}
                        <div class="rounded-3xl border border-emerald-900/8 bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] lg:p-8">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342a4 4 0 100-2.684m0 2.684a4 4 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a4 4 0 105.367-5.367 4 4 0 00-5.367 5.367zm0 9.316a4 4 0 105.368 5.367 4 4 0 00-5.368-5.367z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold text-slate-900">Media sosial</h3>
                                    <p class="text-sm text-slate-500">Tautan akun resmi PRM. Kosongkan jika tidak ada.</p>
                                </div>
                            </div>

                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Instagram</label>
                                    <input type="text" name="instagram" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('instagram', $profil->instagram ?? '') }}">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Facebook</label>
                                    <input type="text" name="facebook" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('facebook', $profil->facebook ?? '') }}">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Youtube</label>
                                    <input type="text" name="youtube" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('youtube', $profil->youtube ?? '') }}">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">WhatsApp</label>
                                    <input type="text" name="whatsapp" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('whatsapp', $profil->whatsapp ?? '') }}">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">TikTok</label>
                                    <input type="text" name="tiktok" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('tiktok', $profil->tiktok ?? '') }}">
                                </div>
                            </div>
                        </div>

                        {{-- ================= TAMPILAN BERANDA ================= --}}
                        <div class="rounded-3xl border border-emerald-900/8 bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] lg:p-8">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 15l4-4a2 2 0 012.8 0l2.2 2.2a2 2 0 002.8 0L19 10" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold text-slate-900">Tampilan beranda</h3>
                                    <p class="text-sm text-slate-500">Background hero dan deskripsi singkat di halaman utama.</p>
                                </div>
                            </div>

                            <div class="mt-6 space-y-5">
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Gambar background beranda</label>
                                    @if (!empty($profil->hero_background_image))
                                        @php
                                            $backgroundPreview = $profil->hero_background_image;
                                            $backgroundPreview = str_starts_with($backgroundPreview, 'http://') || str_starts_with($backgroundPreview, 'https://')
                                                ? $backgroundPreview
                                                : asset('storage/' . $backgroundPreview);
                                        @endphp
                                        <div class="mt-2 mb-2">
                                            <img src="{{ $backgroundPreview }}" alt="Background Beranda" class="h-36 w-full rounded-xl object-cover border border-slate-200">
                                        </div>
                                        <label class="mb-2 flex items-center gap-2 text-xs text-slate-500">
                                            <input type="checkbox" name="remove_hero_background_image" value="1" class="rounded border-slate-300 text-red-600 focus:ring-red-500">
                                            Hapus background lama saat simpan
                                        </label>
                                    @endif
                                    <input type="file" name="hero_background_image" accept="image/*" class="mt-1 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-xs file:font-medium file:text-emerald-800 hover:file:bg-emerald-100">
                                    <p class="mt-1.5 text-xs text-slate-400">Upload file baru untuk mengganti background. Centang hapus jika ingin mengosongkannya.</p>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Deskripsi singkat</label>
                                    <textarea name="deskripsi" rows="3" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
                                </div>

                                <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" class="h-4 w-4 rounded border-slate-300 text-emerald-700 focus:ring-emerald-700" {{ old('is_active', $profil->is_active ?? true) ? 'checked' : '' }}>
                                    <span class="text-sm text-slate-700">Tampilkan profil ini di halaman publik</span>
                                </label>
                            </div>
                        </div>

                        {{-- SIMPAN (desktop) --}}
                        <div class="flex justify-end lg:hidden">
                            <button type="submit" class="rounded-full bg-emerald-700 px-6 py-3 text-sm font-medium text-white shadow-sm shadow-emerald-700/15 transition hover:bg-emerald-800">
                                Simpan perubahan
                            </button>
                        </div>
                    </div>

                    {{-- ================= SIDEBAR RINGKASAN ================= --}}
                    <div class="lg:sticky lg:top-6 space-y-4">
                        <div class="rounded-3xl bg-gradient-to-br from-emerald-800 to-emerald-950 p-6 text-white shadow-[0_18px_40px_rgba(15,23,42,0.12)]">
                            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-[#f1d58a]">Ringkasan tampilan</p>
                            <h4 class="mt-3 text-lg font-semibold leading-snug">Hero beranda, profil, dan struktur pengurus.</h4>
                            <p class="mt-3 text-sm text-emerald-50/85 leading-relaxed">Data di halaman ini dipakai untuk menampilkan identitas PRM secara konsisten di seluruh halaman publik website.</p>

                            <div class="mt-5 pt-5 border-t border-white/10 space-y-2 text-sm">
                                <div class="flex items-center gap-2 text-emerald-50/90">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#f1d58a]"></span>
                                    Identitas & narasi
                                </div>
                                <div class="flex items-center gap-2 text-emerald-50/90">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#f1d58a]"></span>
                                    Kontak & lokasi
                                </div>
                                <div class="flex items-center gap-2 text-emerald-50/90">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#f1d58a]"></span>
                                    Media sosial
                                </div>
                                <div class="flex items-center gap-2 text-emerald-50/90">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#f1d58a]"></span>
                                    Tampilan beranda
                                </div>
                            </div>
                        </div>

                        {{-- SIMPAN (sticky, desktop) --}}
                        <div class="hidden lg:block rounded-3xl border border-emerald-900/8 bg-white p-5 shadow-[0_18px_40px_rgba(15,23,42,0.05)]">
                            <p class="text-sm text-slate-500 mb-3">Pastikan semua bagian sudah terisi sebelum menyimpan.</p>
                            <button type="submit" class="w-full rounded-full bg-emerald-700 px-6 py-3 text-sm font-medium text-white shadow-sm shadow-emerald-700/15 transition hover:bg-emerald-800">
                                Simpan perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>