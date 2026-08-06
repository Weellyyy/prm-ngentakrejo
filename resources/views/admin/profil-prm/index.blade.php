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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if (session('success'))
                <div class="rounded-2xl border border-[#d9b75f]/30 bg-[#fffaf0] p-4 text-emerald-900">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-3xl border border-emerald-900/8 bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] lg:p-8">
                <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Identitas Website</p>
                        <h3 class="mt-2 text-xl font-semibold text-slate-900">Profil PRM Ngentakrejo</h3>
                        <p class="mt-2 text-sm text-slate-500">Kelola informasi dasar, visi, misi, dan latar belakang yang ditampilkan pada halaman publik.</p>

                        <form method="POST" action="{{ route('admin.profil-prm.store') }}" enctype="multipart/form-data" class="mt-6 space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Nama Organisasi</label>
                        <input type="text" name="nama_organisasi" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('nama_organisasi', $profil->nama_organisasi ?? '') }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Visi</label>
                        <textarea name="visi" rows="3" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700">{{ old('visi', $profil->visi ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Misi</label>
                        <textarea name="misi" rows="3" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700">{{ old('misi', $profil->misi ?? '') }}</textarea>
                        <p class="mt-1 text-xs text-slate-500">Tulis satu misi per baris (tekan Enter untuk poin baru).</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Latar Belakang</label>
                        <textarea name="latar_belakang" rows="4" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700">{{ old('latar_belakang', $profil->latar_belakang ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Gambar Pendukung Latar Belakang</label>
                        @if (!empty($profil->latar_belakang_image))
                            @php
                                $latarBelakangPreview = $profil->latar_belakang_image;
                                $latarBelakangPreview = str_starts_with($latarBelakangPreview, 'http://') || str_starts_with($latarBelakangPreview, 'https://')
                                    ? $latarBelakangPreview
                                    : asset('storage/' . $latarBelakangPreview);
                            @endphp
                            <div class="mt-2 mb-3">
                                <img src="{{ $latarBelakangPreview }}" alt="Gambar Latar Belakang" class="h-40 w-full rounded-2xl object-cover border border-emerald-900/10 shadow-sm">
                            </div>
                            <label class="mb-2 flex items-center gap-2 text-sm text-slate-600">
                                <input type="checkbox" name="remove_latar_belakang_image" value="1" class="rounded border-slate-300 text-red-600 focus:ring-red-500">
                                Hapus gambar lama saat simpan
                            </label>
                        @endif
                        <label class="block text-sm font-medium text-slate-700">Ganti gambar</label>
                        <input type="file" name="latar_belakang_image" accept="image/*" class="mt-1 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-emerald-800 hover:file:bg-emerald-100">
                        <p class="mt-2 text-xs text-slate-500">Opsional. Upload gambar untuk mendukung narasi latar belakang/sejarah PRM.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Alamat</label>
                        <textarea name="alamat" rows="2" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Telepon</label>
                            <input type="text" name="telepon" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('telepon', $profil->telepon ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Email</label>
                            <input type="email" name="email" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('email', $profil->email ?? '') }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Instagram</label>
                            <input type="text" name="instagram" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('instagram', $profil->instagram ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Facebook</label>
                            <input type="text" name="facebook" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('facebook', $profil->facebook ?? '') }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Youtube</label>
                            <input type="text" name="youtube" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('youtube', $profil->youtube ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">WhatsApp</label>
                            <input type="text" name="whatsapp" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('whatsapp', $profil->whatsapp ?? '') }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">TikTok</label>
                        <input type="text" name="tiktok" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('tiktok', $profil->tiktok ?? '') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Jam Operasional Kantor</label>
                        <input type="text" name="jam_operasional" placeholder="Senin–Jumat, 08.00–16.00 WIB" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('jam_operasional', $profil->jam_operasional ?? '') }}">
                    </div>
                </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Link Embed Google Maps</label>
                        <input type="url" name="google_maps_embed" placeholder="https://www.google.com/maps/embed?pb=..." class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700" value="{{ old('google_maps_embed', $profil->google_maps_embed ?? '') }}">
                        <p class="mt-2 text-xs text-slate-500">Buka Google Maps → Bagikan → Sematkan peta → salin URL di dalam <code>src="..."</code>, lalu tempel di sini.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Gambar Background Beranda</label>
                        @if (!empty($profil->hero_background_image))
                            @php
                                $backgroundPreview = $profil->hero_background_image;
                                $backgroundPreview = str_starts_with($backgroundPreview, 'http://') || str_starts_with($backgroundPreview, 'https://')
                                    ? $backgroundPreview
                                    : asset('storage/' . $backgroundPreview);
                            @endphp
                            <div class="mt-2 mb-3">
                                <img src="{{ $backgroundPreview }}" alt="Background Beranda" class="h-40 w-full rounded-2xl object-cover border border-emerald-900/10 shadow-sm">
                            </div>
                            <label class="mb-2 flex items-center gap-2 text-sm text-slate-600">
                                <input type="checkbox" name="remove_hero_background_image" value="1" class="rounded border-slate-300 text-red-600 focus:ring-red-500">
                                Hapus background lama saat simpan
                            </label>
                        @endif
                        <label class="block text-sm font-medium text-slate-700">Ganti background</label>
                        <input type="file" name="hero_background_image" accept="image/*" class="mt-1 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-emerald-800 hover:file:bg-emerald-100">
                        <p class="mt-2 text-xs text-slate-500">Upload file baru untuk mengganti background. Centang hapus jika ingin mengosongkannya.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Deskripsi Singkat</label>
                        <textarea name="deskripsi" rows="3" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-700" {{ old('is_active', $profil->is_active ?? true) ? 'checked' : '' }}>
                        <label class="ml-2 text-sm text-slate-700">Tampilkan profil ini</label>
                    </div>

                    <div>
                        <button type="submit" class="rounded-full bg-emerald-700 px-5 py-2.5 text-white shadow-sm shadow-emerald-700/15 transition hover:bg-emerald-800">
                            Simpan
                        </button>
                    </div>
                        </form>
                    </div>

                    <div class="rounded-3xl bg-gradient-to-br from-emerald-800 to-emerald-950 p-6 text-white shadow-[0_18px_40px_rgba(15,23,42,0.12)]">
                        <p class="text-sm uppercase tracking-[0.25em] text-[#f1d58a]">Ringkasan Tampilan</p>
                        <h4 class="mt-3 text-xl font-semibold">Hero beranda, profil, dan struktur pengurus.</h4>
                        <p class="mt-3 text-sm text-emerald-50/85">Data di halaman ini dipakai untuk menampilkan identitas PRM yang konsisten di seluruh halaman publik.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>