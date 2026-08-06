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
            <div class="rounded-3xl border border-emerald-900/8 bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] lg:p-8">
                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Daftar Data</p>
                        <h3 class="mt-2 text-xl font-semibold text-slate-900">{{ $config['label'] }}</h3>
                        <p class="mt-1 text-sm text-slate-500">Klik "Edit" untuk mengubah data.</p>
                    </div>
                    <span class="rounded-full bg-[#f8fbf9] border border-emerald-900/10 px-4 py-2 text-sm font-medium text-emerald-800">Total: {{ $items->count() }}</span>
                </div>

                <div class="mt-6 space-y-3">
                    @forelse ($items as $item)
                        @php
                            $imageField = collect($config['fields'])->firstWhere('type', 'image');
                            $imageValue = $imageField ? $item->{$imageField['name']} : null;
                            if ($imageValue) {
                                $imageValue = str_starts_with($imageValue, 'http://') || str_starts_with($imageValue, 'https://')
                                    ? $imageValue
                                    : asset('storage/' . $imageValue);
                            }

                            $titleField = collect($config['fields'])->first(fn ($f) => in_array($f['name'], ['nama', 'name', 'judul', 'title']));
                            $badgeFields = collect($config['fields'])->filter(fn ($f) => in_array($f['name'], ['jabatan', 'bidang', 'kategori', 'status']));
                            $detailFields = collect($config['fields'])->reject(function ($f) use ($imageField, $titleField, $badgeFields) {
                                return ($imageField && $f['name'] === $imageField['name'])
                                    || ($titleField && $f['name'] === $titleField['name'])
                                    || $badgeFields->contains('name', $f['name'])
                                    || $f['type'] === 'textarea';
                            });
                            $bioField = collect($config['fields'])->firstWhere('type', 'textarea');
                        @endphp

                        <div class="rounded-2xl border border-slate-200 bg-white p-5 transition hover:border-emerald-700/30 hover:shadow-sm">
                            <div class="flex items-start justify-between gap-6 flex-wrap">
                                <div class="flex items-start gap-4 min-w-0">
                                    @if ($imageValue)
                                        <img src="{{ $imageValue }}" alt="Foto" class="h-16 w-16 rounded-full object-cover border border-slate-200 shrink-0">
                                    @else
                                        <div class="h-16 w-16 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 text-xs font-medium shrink-0">
                                            Foto
                                        </div>
                                    @endif

                                    <div class="min-w-0">
                                        @if ($titleField)
                                            <h4 class="text-base font-semibold text-slate-900 truncate">{{ $item->{$titleField['name']} ?: '-' }}</h4>
                                        @endif

                                        @if ($badgeFields->isNotEmpty())
                                            <div class="mt-1.5 flex flex-wrap items-center gap-1.5">
                                                @foreach ($badgeFields as $field)
                                                    @php $value = $item->{$field['name']}; @endphp
                                                    @if ($value)
                                                        <span class="inline-flex items-center rounded-full bg-emerald-50 border border-emerald-700/15 px-2.5 py-0.5 text-xs font-medium text-emerald-800">
                                                            @if ($field['type'] === 'select' && isset($field['options'][$value]))
                                                                {{ $field['options'][$value] }}
                                                            @else
                                                                {{ $value }}
                                                            @endif
                                                        </span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif

                                        @if ($detailFields->isNotEmpty())
                                            <dl class="mt-3 flex flex-wrap gap-x-6 gap-y-1 text-sm">
                                                @foreach ($detailFields as $field)
                                                    @php $value = $item->{$field['name']}; @endphp
                                                    @if ($value)
                                                        <div class="flex items-center gap-1.5">
                                                            <dt class="text-slate-400">{{ $field['label'] }}</dt>
                                                            <dd class="text-slate-700 font-medium">{{ $value }}</dd>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </dl>
                                        @endif

                                        @if ($bioField && $item->{$bioField['name']})
                                            <p class="mt-3 text-sm text-slate-500 leading-relaxed max-w-2xl">
                                                {{ $item->{$bioField['name']} }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 shrink-0">
                                    <button type="button" onclick="openModal('modal-edit-{{ $item->id }}')"
                                        class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-sm font-medium text-slate-700 transition hover:border-emerald-700 hover:text-emerald-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </button>

                                    <form method="POST" action="{{ route('admin.content.destroy', [$type, $item->id]) }}" onsubmit="return confirm('Hapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-sm font-medium text-red-600 transition hover:border-red-300 hover:bg-red-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- ================= MODAL EDIT (per item) ================= --}}
                        <div id="modal-edit-{{ $item->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 p-4" onclick="if(event.target === this) closeModal('modal-edit-{{ $item->id }}')">
                            <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-3xl bg-white p-6 shadow-2xl lg:p-8">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Edit Data</p>
                                        <h3 class="mt-1 text-xl font-semibold text-slate-900">{{ $config['label'] }}</h3>
                                    </div>
                                    <button type="button" onclick="closeModal('modal-edit-{{ $item->id }}')"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-full text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <form method="POST" action="{{ route('admin.content.update', [$type, $item->id]) }}" enctype="multipart/form-data" class="mt-6 grid gap-4 lg:grid-cols-2">
                                    @csrf
                                    @method('PUT')

                                    @foreach ($config['fields'] as $field)
                                        @php
                                            $editValue = old($field['name'] . '_' . $item->id, $item->{$field['name']});
                                            if ($field['type'] === 'time' && $editValue) {
                                                $editValue = \Illuminate\Support\Str::substr($editValue, 0, 5);
                                            }
                                        @endphp
                                        <div class="{{ $field['type'] === 'textarea' || $field['type'] === 'image' ? 'lg:col-span-2' : '' }}">
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
                                            @elseif ($field['type'] === 'image')
                                                @if (!empty($item->{$field['name']}))
                                                    @php
                                                        $currentImage = $item->{$field['name']};
                                                        $currentImage = str_starts_with($currentImage, 'http://') || str_starts_with($currentImage, 'https://')
                                                            ? $currentImage
                                                            : asset('storage/' . $currentImage);
                                                    @endphp
                                                    <div class="mt-2 mb-3 flex items-center gap-3">
                                                        <img src="{{ $currentImage }}" alt="{{ $field['label'] }}" class="h-16 w-16 rounded-full object-cover border border-slate-200">
                                                        <label class="flex items-center gap-2 text-sm text-slate-600">
                                                            <input type="checkbox" name="remove_{{ $field['name'] }}" value="1" class="rounded border-slate-300 text-red-600 focus:ring-red-500">
                                                            Hapus foto lama
                                                        </label>
                                                    </div>
                                                @endif
                                                <input type="file" name="{{ $field['name'] }}" accept="image/*"
                                                    class="mt-1.5 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-emerald-800 hover:file:bg-emerald-100">
                                            @else
                                                <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" value="{{ $editValue }}"
                                                    class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 shadow-sm focus:border-emerald-700 focus:ring-emerald-700 text-sm">
                                            @endif

                                            @error($field['name'])
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endforeach

                                    <div class="lg:col-span-2 flex items-center gap-3 pt-2 border-t border-slate-100 mt-2">
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
                        <p class="text-slate-500 py-6">Belum ada data {{ strtolower($config['label']) }}.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- ================= MODAL TAMBAH ================= --}}
    <div id="modal-tambah" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 p-4" onclick="if(event.target === this) closeModal('modal-tambah')">
        <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-3xl bg-white p-6 shadow-2xl lg:p-8">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Form Tambah</p>
                    <h3 class="mt-1 text-xl font-semibold text-slate-900">Tambah {{ $config['label'] }}</h3>
                </div>
                <button type="button" onclick="closeModal('modal-tambah')"
                    class="inline-flex h-9 w-9 items-center justify-center rounded-full text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.content.store', $type) }}" enctype="multipart/form-data" class="mt-6 grid gap-4 lg:grid-cols-2">
                @csrf
                @foreach ($config['fields'] as $field)
                    @php $createValue = old($field['name']); @endphp
                    <div class="{{ $field['type'] === 'textarea' ? 'lg:col-span-2' : '' }}">
                        <label class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">{{ $field['label'] }}</label>

                        @if ($field['type'] === 'textarea')
                            <textarea name="{{ $field['name'] }}" rows="4" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 shadow-sm focus:border-emerald-700 focus:ring-emerald-700 text-sm">{{ $createValue }}</textarea>
                        @elseif ($field['type'] === 'select')
                            <select name="{{ $field['name'] }}" class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 shadow-sm focus:border-emerald-700 focus:ring-emerald-700 text-sm">
                                <option value="">Pilih {{ $field['label'] }}</option>
                                @foreach ($field['options'] as $value => $label)
                                    <option value="{{ $value }}" @selected($createValue === (string) $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        @elseif ($field['type'] === 'image')
                            <input type="file" name="{{ $field['name'] }}" accept="image/*"
                                class="mt-1.5 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-emerald-800 hover:file:bg-emerald-100">
                        @else
                            <input type="{{ $field['type'] }}" name="{{ $field['name'] }}"
                                value="{{ $field['type'] === 'time' && $createValue ? \Illuminate\Support\Str::substr($createValue, 0, 5) : $createValue }}"
                                class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 shadow-sm focus:border-emerald-700 focus:ring-emerald-700 text-sm">
                        @endif

                        @error($field['name'])
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach

                <div class="lg:col-span-2 flex items-center gap-3 pt-2 border-t border-slate-100 mt-2">
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