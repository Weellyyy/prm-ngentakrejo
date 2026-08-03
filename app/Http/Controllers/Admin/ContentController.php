<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Artikel;
use App\Models\Iklan;
use App\Models\LaporanDonasi;
use App\Models\Pengurus;
use App\Models\ProgramKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    private function configs(): array
    {
        return [
            'pengurus' => [
            'label' => 'Pengurus',
            'model' => Pengurus::class,
            'orderBy' => ['urutan', 'asc'],
            'fields' => [
                ['name' => 'nama', 'label' => 'Nama', 'type' => 'text'],
                ['name' => 'jabatan', 'label' => 'Jabatan', 'type' => 'text'],
                ['name' => 'bidang', 'label' => 'Bidang', 'type' => 'select', 'options' => ['Pimpinan' => 'Pimpinan', 'Majelis' => 'Majelis']],
                ['name' => 'periode_jabatan', 'label' => 'Periode Jabatan', 'type' => 'text'],
                ['name' => 'kontak', 'label' => 'No. HP / Email', 'type' => 'text'],
                ['name' => 'bio', 'label' => 'Bio Singkat', 'type' => 'textarea'],
                ['name' => 'gambar', 'label' => 'Foto', 'type' => 'image'],
                ['name' => 'urutan', 'label' => 'Urutan', 'type' => 'number'],
            ],
            'summary' => ['nama', 'jabatan', 'bidang'],
            ],
            'agenda' => [
            'label' => 'Agenda Kegiatan',
            'model' => Agenda::class,
            'orderBy' => ['tanggal', 'asc'],
            'fields' => [
                ['name' => 'judul', 'label' => 'Judul', 'type' => 'text'],
                ['name' => 'tanggal', 'label' => 'Tanggal', 'type' => 'date'],
                ['name' => 'waktu', 'label' => 'Waktu', 'type' => 'time'],
                ['name' => 'lokasi', 'label' => 'Lokasi', 'type' => 'text'],
                ['name' => 'deskripsi', 'label' => 'Deskripsi', 'type' => 'textarea'],
                ['name' => 'gambar', 'label' => 'Poster/Gambar Kegiatan', 'type' => 'image'],
                ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'options' => ['Akan Datang' => 'Akan Datang', 'Berlangsung' => 'Berlangsung', 'Selesai' => 'Selesai']],
                ['name' => 'penanggung_jawab', 'label' => 'Penanggung Jawab / Kontak', 'type' => 'text'],
            ],
            'summary' => ['judul', 'tanggal', 'lokasi'],
        ],
            'program-kerja' => [
                'label' => 'Program Kerja',
                'model' => ProgramKerja::class,
                'orderBy' => ['created_at', 'desc'],
                'fields' => [
                    ['name' => 'judul', 'label' => 'Judul', 'type' => 'text'],
                    ['name' => 'majelis', 'label' => 'Majelis', 'type' => 'text'],
                    ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'options' => ['Direncanakan' => 'Direncanakan', 'Berjalan' => 'Berjalan', 'Selesai' => 'Selesai']],
                    ['name' => 'deskripsi', 'label' => 'Deskripsi', 'type' => 'textarea'],
                ],
                'summary' => ['judul', 'majelis', 'status'],
            ],
            'media-dakwah' => [
                'label' => 'Media Dakwah',
                'model' => Artikel::class,
                'orderBy' => ['tanggal', 'desc'],
                'fields' => [
                    ['name' => 'judul', 'label' => 'Judul', 'type' => 'text'],
                    ['name' => 'penulis', 'label' => 'Penulis', 'type' => 'text'],
                    ['name' => 'tanggal', 'label' => 'Tanggal', 'type' => 'date'],
                    ['name' => 'ringkasan', 'label' => 'Ringkasan', 'type' => 'textarea'],
                    ['name' => 'isi', 'label' => 'Isi', 'type' => 'textarea'],
                    ['name' => 'gambar', 'label' => 'Gambar', 'type' => 'image'],
                ],
                'summary' => ['judul', 'penulis', 'tanggal'],
            ],
            'ruang-iklan' => [
                'label' => 'Ruang Iklan',
                'model' => Iklan::class,
                'orderBy' => ['created_at', 'desc'],
                'fields' => [
                    ['name' => 'nama', 'label' => 'Nama Iklan', 'type' => 'text'],
                    ['name' => 'kontak', 'label' => 'Kontak', 'type' => 'text'],
                    ['name' => 'deskripsi', 'label' => 'Deskripsi', 'type' => 'textarea'],
                    ['name' => 'gambar', 'label' => 'Gambar', 'type' => 'image'],
                    ['name' => 'tanggal_expired', 'label' => 'Tanggal Expired', 'type' => 'date'],
                ],
                'summary' => ['nama', 'kontak', 'tanggal_expired'],
            ],
            'donasi' => [
                'label' => 'Donasi',
                'model' => LaporanDonasi::class,
                'orderBy' => ['created_at', 'desc'],
                'fields' => [
                    ['name' => 'periode', 'label' => 'Periode', 'type' => 'text'],
                    ['name' => 'masuk', 'label' => 'Masuk', 'type' => 'number'],
                    ['name' => 'keluar', 'label' => 'Keluar', 'type' => 'number'],
                    ['name' => 'keterangan', 'label' => 'Keterangan', 'type' => 'textarea'],
                ],
                'summary' => ['periode', 'masuk', 'keluar'],
            ],
        ];
    }

    private function config(string $type): array
    {
        abort_unless(array_key_exists($type, $this->configs()), 404);

        return $this->configs()[$type];
    }

    private function modelClass(string $type): string
    {
        return $this->config($type)['model'];
    }

    private function rules(string $type): array
    {
        $rules = [];

        foreach ($this->config($type)['fields'] as $field) {
            $ruleSet = ['nullable'];

            if ($field['type'] === 'text' || $field['type'] === 'textarea' || $field['type'] === 'select') {
                $ruleSet[] = 'string';
            } elseif ($field['type'] === 'date') {
                $ruleSet[] = 'date';
            } elseif ($field['type'] === 'time') {
                $ruleSet[] = 'date_format:H:i';
            } elseif ($field['type'] === 'number') {
                $ruleSet[] = 'numeric';
            } elseif ($field['type'] === 'image') {
                $ruleSet[] = 'image';
            }

            if ($field['type'] === 'image') {
                $ruleSet[] = 'max:2048';
            }

            if ($field['type'] === 'select' && isset($field['options'])) {
                $ruleSet[] = 'in:'.implode(',', array_keys($field['options']));
            }

            $rules[$field['name']] = $ruleSet;
        }

        return $rules;
    }

    private function imageFields(string $type): array
    {
        return collect($this->config($type)['fields'])
            ->filter(fn ($field) => $field['type'] === 'image')
            ->pluck('name')
            ->all();
    }

    private function isStoredImagePath(?string $path): bool
    {
        return !empty($path) && !str_starts_with($path, 'http://') && !str_starts_with($path, 'https://');
    }

    private function storeUploadedImages(Request $request, string $type, array $data, ?object $existing = null): array
    {
        foreach ($this->imageFields($type) as $fieldName) {
            $removeFlag = $request->boolean('remove_'.$fieldName);

            if ($removeFlag && $existing && $this->isStoredImagePath($existing->{$fieldName} ?? null)) {
                Storage::disk('public')->delete($existing->{$fieldName});
                $data[$fieldName] = null;
                continue;
            }

            if ($request->hasFile($fieldName)) {
                if ($existing && $this->isStoredImagePath($existing->{$fieldName} ?? null)) {
                    Storage::disk('public')->delete($existing->{$fieldName});
                }

                $data[$fieldName] = $request->file($fieldName)->store($type, 'public');
                continue;
            }

            if ($existing) {
                $data[$fieldName] = $existing->{$fieldName};
            } else {
                unset($data[$fieldName]);
            }
        }

        return $data;
    }

    private function deleteUploadedImages(string $type, object $item): void
    {
        foreach ($this->imageFields($type) as $fieldName) {
            if ($this->isStoredImagePath($item->{$fieldName} ?? null)) {
                Storage::disk('public')->delete($item->{$fieldName});
            }
        }
    }

    public function index(string $type)
    {
        $config = $this->config($type);
        $modelClass = $this->modelClass($type);

        $query = $modelClass::query();

        if (!empty($config['orderBy'])) {
            [$column, $direction] = $config['orderBy'];
            $query->orderBy($column, $direction);
        }

        $items = $query->get();

        return view('admin.content.index', [
            'type' => $type,
            'config' => $config,
            'items' => $items,
        ]);
    }

    public function store(Request $request, string $type)
    {
        $config = $this->config($type);
        $modelClass = $this->modelClass($type);
        $data = $request->validate($this->rules($type));
        $data = $this->storeUploadedImages($request, $type, $data);

        $modelClass::create($data);

        return Redirect::route('admin.content.index', $type)->with('success', $config['label'].' berhasil ditambahkan.');
    }

    public function update(Request $request, string $type, int $id)
    {
        $config = $this->config($type);
        $modelClass = $this->modelClass($type);
        $item = $modelClass::findOrFail($id);
        $data = $request->validate($this->rules($type));
        $data = $this->storeUploadedImages($request, $type, $data, $item);

        $item->update($data);

        return Redirect::route('admin.content.index', $type)->with('success', $config['label'].' berhasil diperbarui.');
    }

    public function destroy(string $type, int $id)
    {
        $config = $this->config($type);
        $modelClass = $this->modelClass($type);
        $item = $modelClass::findOrFail($id);

        $this->deleteUploadedImages($type, $item);

        $item->delete();

        return Redirect::route('admin.content.index', $type)->with('success', $config['label'].' berhasil dihapus.');
    }
}