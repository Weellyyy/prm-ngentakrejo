<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-emerald-700">Kelola Konten</p>
                <h2 class="mt-1 font-semibold text-2xl text-slate-900 leading-tight">
                    {{ $config['label'] }}
                </h2>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" onclick="openModal('modal-tambah')"
                    class="inline-flex items-center gap-1.5 rounded-full bg-emerald-700 px-4 py-2 text-sm font-medium text-white shadow-sm shadow-emerald-700/15 transition hover:bg-emerald-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah {{ $config['label'] }}
                </button>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-full border border-emerald-900/10 bg-white px-4 py-2 text-sm font-medium text-emerald-800 transition hover:border-emerald-700 hover:bg-[#f8fbf9]">Kembali ke Dashboard</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if (session('success'))
                <div class="rounded-2xl border border-[#d9b75f]/30 bg-[#fffaf0] p-4 text-emerald-900">
                    {{ session('success') }}
                </div>
            @endif

            {{-- DAFTAR DATA --}}
            <div class="rounded-3xl border border-emerald-900/8 bg-white p-0 shadow-[0_18px_40px_rgba(15,23,42,0.05)] overflow-hidden">
                <div class="p-6 lg:p-8 border-b border-slate-100 flex items-start justify-between gap-4 flex-wrap">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Daftar Data</p>
                        <h3 class="mt-2 text-xl font-semibold text-slate-900">{{ $config['label'] }}</h3>
                        <p class="mt-1 text-sm text-slate-500">Daftar semua media dakwah yang telah diunggah.</p>
                    </div>
                    <span class="rounded-full bg-[#f8fbf9] border border-emerald-900/10 px-4 py-2 text-sm font-medium text-emerald-800">Total: {{ $items->count() }}</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold">
                            <tr>
                                <th class="px-6 py-4">Judul Konten</th>
                                <th class="px-6 py-4 text-center">Jenis Media</th>
                                <th class="px-6 py-4">Isi Konten</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($items as $item)
                                @php
                                    $fileUrl = null;
                                    if ($item->file_media) {
                                        $fileUrl = str_starts_with($item->file_media, 'http://') || str_starts_with($item->file_media, 'https://')
                                            ? $item->file_media
                                            : asset('storage/' . $item->file_media);
                                    }

                                    // Badge Colors
                                    $badgeColor = 'bg-emerald-100 text-emerald-800 border-emerald-200';
                                    $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>';
                                    if ($item->jenis_media === 'video') {
                                        $badgeColor = 'bg-purple-100 text-purple-800 border-purple-200';
                                        $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>';
                                    } elseif ($item->jenis_media === 'audio') {
                                        $badgeColor = 'bg-amber-100 text-amber-800 border-amber-200';
                                        $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" /></svg>';
                                    } elseif ($item->jenis_media === 'infografis') {
                                        $badgeColor = 'bg-blue-100 text-blue-800 border-blue-200';
                                        $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>';
                                    }
                                @endphp
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-4 align-top">
                                        <div class="flex items-start gap-4">
                                            @php
                                                $thumbnail = null;
                                                $gambarUrl = $item->gambar ? (str_starts_with($item->gambar, 'http') ? $item->gambar : asset('storage/' . $item->gambar)) : null;
                                                if ($item->jenis_media !== 'audio') {
                                                    $thumbnail = $fileUrl ?: $gambarUrl;
                                                } else {
                                                    $thumbnail = $gambarUrl;
                                                }
                                            @endphp
                                            
                                            @if($thumbnail)
                                                <img src="{{ $thumbnail }}" alt="" class="h-16 w-24 object-cover rounded-lg shadow-sm shrink-0">
                                            @else
                                                <div class="h-16 w-24 bg-emerald-900 rounded-lg flex items-center justify-center shadow-sm text-white relative overflow-hidden shrink-0">
                                                    @if($item->jenis_media === 'video')
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                    @elseif($item->jenis_media === 'audio')
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" /></svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3m0 0l3-3m-3 3V8" /></svg>
                                                    @endif
                                                </div>
                                            @endif
                                            <div class="min-w-0">
                                                <h4 class="font-semibold text-slate-900 leading-tight">{{ $item->judul }}</h4>
                                                <p class="text-xs text-slate-400 mt-1">{{ $item->created_at->translatedFormat('d F Y') }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 align-top text-center">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg border text-xs font-medium {{ $badgeColor }}">
                                            {!! $icon !!}
                                            {{ ucfirst($item->jenis_media) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 align-top">
                                        @if ($item->jenis_media === 'audio' && $fileUrl)
                                            <audio controls class="h-10 w-full max-w-xs rounded-full bg-slate-100">
                                                <source src="{{ $fileUrl }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @elseif ($item->jenis_media === 'video' && $item->isi)
                                            <a href="{{ $item->isi }}" target="_blank" class="text-emerald-700 hover:underline inline-flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                                {{ Str::limit($item->isi, 40) }}
                                            </a>
                                        @elseif ($item->jenis_media === 'infografis' && $item->isi)
                                            <div class="text-sm text-slate-600 line-clamp-2 max-w-md">
                                                {{ strip_tags($item->isi) }}
                                            </div>
                                        @elseif ($item->jenis_media === 'infografis' && $item->file_media)
                                            <span class="inline-flex items-center gap-1.5 text-slate-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                Gambar Infografis
                                            </span>
                                        @else
                                            <div class="text-sm text-slate-600 line-clamp-2 max-w-md">
                                                {{ strip_tags($item->isi) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 align-top text-right space-y-2">
                                        <div class="flex justify-end gap-2">
                                            <button type="button" onclick="openModal('modal-edit-{{ $item->id }}')" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-emerald-700/20 text-emerald-700 bg-white hover:bg-emerald-50 hover:border-emerald-700 transition text-sm font-medium">
                                                Lihat / Edit
                                            </button>
                                            <form method="POST" action="{{ route('admin.content.destroy', [$type, $item->id]) }}" onsubmit="return confirm('Hapus data ini?');" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center h-8 w-8 rounded-lg border border-slate-200 text-red-600 hover:bg-red-50 hover:border-red-300 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                {{-- MODAL EDIT --}}
                                <div id="modal-edit-{{ $item->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 p-4" onclick="if(event.target === this) closeModal('modal-edit-{{ $item->id }}')">
                                    <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-3xl bg-white p-6 shadow-2xl lg:p-8">
                                        <div class="flex items-start justify-between gap-4">
                                            <div>
                                                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Edit Data</p>
                                                <h3 class="mt-1 text-xl font-semibold text-slate-900">{{ $config['label'] }}</h3>
                                            </div>
                                            <button type="button" onclick="closeModal('modal-edit-{{ $item->id }}')"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-full text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ route('admin.content.update', [$type, $item->id]) }}" enctype="multipart/form-data" class="mt-6 grid gap-4 lg:grid-cols-2">
                                            @csrf
                                            @method('PUT')
                                            
                                            @foreach ($config['fields'] as $field)
                                                @php $editValue = old($field['name'] . '_' . $item->id, $item->{$field['name']}); @endphp
                                                <div class="lg:col-span-2">
                                                    <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">{{ $field['label'] }}</label>
                                                    @if ($field['type'] === 'textarea')
                                                        <textarea name="{{ $field['name'] }}" rows="3" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 shadow-sm focus:border-emerald-700 focus:ring-emerald-700 text-sm">{{ $editValue }}</textarea>
                                                    @elseif ($field['type'] === 'select')
                                                        <select name="{{ $field['name'] }}" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 shadow-sm focus:border-emerald-700 focus:ring-emerald-700 text-sm">
                                                            <option value="">Pilih {{ $field['label'] }}</option>
                                                            @foreach ($field['options'] as $value => $label)
                                                                <option value="{{ $value }}" @selected((string) $editValue === (string) $value)>{{ $label }}</option>
                                                            @endforeach
                                                        </select>
                                                    @elseif ($field['type'] === 'file' || $field['type'] === 'image')
                                                        @if (!empty($item->{$field['name']}))
                                                            @php
                                                                $currentFile = $item->{$field['name']};
                                                                $currentFile = str_starts_with($currentFile, 'http://') || str_starts_with($currentFile, 'https://') ? $currentFile : asset('storage/' . $currentFile);
                                                            @endphp
                                                            <div class="mt-2 mb-3">
                                                                @if ($item->jenis_media === 'audio' && $field['type'] === 'file')
                                                                    <audio controls class="h-10 w-full max-w-sm rounded-full bg-slate-100 mb-2">
                                                                        <source src="{{ $currentFile }}" type="audio/mpeg">
                                                                    </audio>
                                                                @elseif ($item->jenis_media === 'infografis')
                                                                    <img src="{{ $currentFile }}" alt="{{ $field['label'] }}" class="h-24 w-auto rounded border border-slate-200 mb-2 object-cover">
                                                                @else
                                                                    <p class="text-sm text-slate-500 mb-2"><a href="{{ $currentFile }}" target="_blank" class="text-emerald-700 hover:underline">Lihat File Tersimpan</a></p>
                                                                @endif
                                                                <label class="flex items-center gap-2 text-sm text-slate-600">
                                                                    <input type="checkbox" name="remove_{{ $field['name'] }}" value="1" class="rounded border-slate-300 text-red-600 focus:ring-red-500">
                                                                    Hapus file lama
                                                                </label>
                                                            </div>
                                                        @endif
                                                        <input type="file" name="{{ $field['name'] }}" accept="image/*, audio/*, .pdf"
                                                            class="mt-1.5 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-emerald-800 hover:file:bg-emerald-100">
                                                        <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah file.</p>
                                                    @else
                                                        <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" value="{{ $editValue }}"
                                                            class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 shadow-sm focus:border-emerald-700 focus:ring-emerald-700 text-sm">
                                                    @endif
                                                    @error($field['name'])
                                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            @endforeach

                                            <div class="lg:col-span-2 flex items-center gap-3 pt-4 border-t border-slate-100 mt-2">
                                                <button type="submit" class="inline-flex items-center rounded-full bg-emerald-700 px-5 py-2.5 text-sm font-medium text-white shadow-sm shadow-emerald-700/15 transition hover:bg-emerald-800">
                                                    Simpan perubahan
                                                </button>
                                                <button type="button" onclick="closeModal('modal-edit-{{ $item->id }}')"
                                                    class="inline-flex items-center rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                                                    Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                                        Belum ada data media dakwah.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div id="modal-tambah" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 p-4" onclick="if(event.target === this) closeModal('modal-tambah')">
        <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-3xl bg-white p-6 shadow-2xl lg:p-8">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Form Tambah</p>
                    <h3 class="mt-1 text-xl font-semibold text-slate-900">Tambah {{ $config['label'] }}</h3>
                </div>
                <button type="button" onclick="closeModal('modal-tambah')"
                    class="inline-flex h-9 w-9 items-center justify-center rounded-full text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.content.store', $type) }}" enctype="multipart/form-data" class="mt-6 grid gap-4 lg:grid-cols-2">
                @csrf
                @foreach ($config['fields'] as $field)
                    @php $createValue = old($field['name']); @endphp
                    <div class="lg:col-span-2">
                        <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">{{ $field['label'] }}</label>
                        @if ($field['type'] === 'textarea')
                            <textarea name="{{ $field['name'] }}" rows="3" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 shadow-sm focus:border-emerald-700 focus:ring-emerald-700 text-sm">{{ $createValue }}</textarea>
                        @elseif ($field['type'] === 'select')
                            <select name="{{ $field['name'] }}" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 shadow-sm focus:border-emerald-700 focus:ring-emerald-700 text-sm">
                                <option value="">Pilih {{ $field['label'] }}</option>
                                @foreach ($field['options'] as $value => $label)
                                    <option value="{{ $value }}" @selected($createValue === (string) $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        @elseif ($field['type'] === 'file' || $field['type'] === 'image')
                            <input type="file" name="{{ $field['name'] }}" accept="image/*, audio/*, .pdf"
                                class="mt-1.5 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-emerald-800 hover:file:bg-emerald-100">
                        @else
                            <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" value="{{ $createValue }}"
                                class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 shadow-sm focus:border-emerald-700 focus:ring-emerald-700 text-sm">
                        @endif
                        @error($field['name'])
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach

                <div class="lg:col-span-2 flex items-center gap-3 pt-4 border-t border-slate-100 mt-2">
                    <button type="submit" class="inline-flex items-center rounded-full bg-emerald-700 px-5 py-2.5 text-sm font-medium text-white shadow-sm shadow-emerald-700/15 transition hover:bg-emerald-800">
                        Simpan {{ $config['label'] }}
                    </button>
                    <button type="button" onclick="closeModal('modal-tambah')"
                        class="inline-flex items-center rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('[id^="modal-"]').forEach(function (modal) {
                    if (!modal.classList.contains('hidden')) {
                        closeModal(modal.id);
                    }
                });
            }
        });

        @if ($errors->any())
            @if (old('_token') && request()->routeIs('admin.content.store'))
                openModal('modal-tambah');
            @endif
        @endif
    </script>
</x-app-layout>
