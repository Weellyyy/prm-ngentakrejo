<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil PRM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.profil-prm.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Organisasi</label>
                        <input type="text" name="nama_organisasi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('nama_organisasi', $profil->nama_organisasi ?? '') }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Visi</label>
                        <textarea name="visi" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('visi', $profil->visi ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Misi</label>
                        <textarea name="misi" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('misi', $profil->misi ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Latar Belakang</label>
                        <textarea name="latar_belakang" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('latar_belakang', $profil->latar_belakang ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Telepon</label>
                            <input type="text" name="telepon" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('telepon', $profil->telepon ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('email', $profil->email ?? '') }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Instagram</label>
                            <input type="text" name="instagram" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('instagram', $profil->instagram ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Facebook</label>
                            <input type="text" name="facebook" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('facebook', $profil->facebook ?? '') }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Youtube</label>
                            <input type="text" name="youtube" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('youtube', $profil->youtube ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">WhatsApp</label>
                            <input type="text" name="whatsapp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('whatsapp', $profil->whatsapp ?? '') }}">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gambar Background Beranda</label>
                        <input type="text" name="hero_background_image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('hero_background_image', $profil->hero_background_image ?? '') }}" placeholder="https://... atau /storage/...">
                        <p class="mt-1 text-xs text-gray-500">Isi dengan URL gambar atau path publik yang bisa dipakai sebagai background hero beranda.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                        <textarea name="deskripsi" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $profil->is_active ?? true) ? 'checked' : '' }}>
                        <label class="ml-2 text-sm text-gray-700">Tampilkan profil ini</label>
                    </div>

                    <div>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
