<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilPrm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfilPrmController extends Controller
{
    private function isStoredImagePath(?string $path): bool
    {
        return !empty($path) && !str_starts_with($path, 'http://') && !str_starts_with($path, 'https://');
    }

    public function index()
    {
        $profil = ProfilPrm::latest()->first();

        return view('admin.profil-prm.index', compact('profil'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_organisasi' => 'nullable|string|max:255',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'latar_belakang' => 'nullable|string',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'hero_background_image' => 'nullable|image|max:2048',
            'latar_belakang_image' => 'nullable|image|max:2048',
            'deskripsi' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        $profil = ProfilPrm::latest()->first();

        // Hero background image
        if ($request->boolean('remove_hero_background_image') && $profil && $this->isStoredImagePath($profil->hero_background_image ?? null)) {
            Storage::disk('public')->delete($profil->hero_background_image);
            $data['hero_background_image'] = null;
        }

        if ($request->hasFile('hero_background_image')) {
            if ($profil && $this->isStoredImagePath($profil->hero_background_image ?? null)) {
                Storage::disk('public')->delete($profil->hero_background_image);
            }

            $data['hero_background_image'] = $request->file('hero_background_image')->store('profil-prm', 'public');
        } elseif ($profil) {
            $data['hero_background_image'] = $profil->hero_background_image;
        } else {
            unset($data['hero_background_image']);
        }

        // Latar belakang image
        if ($request->boolean('remove_latar_belakang_image') && $profil && $this->isStoredImagePath($profil->latar_belakang_image ?? null)) {
            Storage::disk('public')->delete($profil->latar_belakang_image);
            $data['latar_belakang_image'] = null;
        }

        if ($request->hasFile('latar_belakang_image')) {
            if ($profil && $this->isStoredImagePath($profil->latar_belakang_image ?? null)) {
                Storage::disk('public')->delete($profil->latar_belakang_image);
            }

            $data['latar_belakang_image'] = $request->file('latar_belakang_image')->store('profil-prm', 'public');
        } elseif ($profil) {
            $data['latar_belakang_image'] = $profil->latar_belakang_image;
        } else {
            unset($data['latar_belakang_image']);
        }

        ProfilPrm::create($data);

        return Redirect::route('admin.profil-prm.index')->with('success', 'Profil PRM berhasil disimpan.');
    }
}