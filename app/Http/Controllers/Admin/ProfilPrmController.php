<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilPrm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProfilPrmController extends Controller
{
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
            'deskripsi' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        ProfilPrm::create($data);

        return Redirect::route('admin.profil-prm.index')->with('success', 'Profil PRM berhasil disimpan.');
    }
}
