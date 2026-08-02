<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-emerald-700">Kelola Konten</p>
                <h2 class="mt-1 font-semibold text-2xl text-slate-900 leading-tight">
                    {{ $config['label'] }}
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
                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Form Tambah</p>
                <h3 class="mt-2 text-xl font-semibold text-slate-900">Tambah {{ $config['label'] }}</h3>
                <form method="POST" action="{{ route('admin.content.store', $type) }}" enctype="multipart/form-data" class="mt-6 grid gap-4 lg:grid-cols-2">
                    @csrf
                    @foreach ($config['fields'] as $field)
                        @php
                            $createValue = old($field['name']);
                        @endphp
                        <div class="{{ $field['type'] === 'textarea' ? 'lg:col-span-2' : '' }}">
                            <label class="block text-sm font-medium text-slate-700">{{ $field['label'] }}</label>

                            @if ($field['type'] === 'textarea')
                                <textarea name="{{ $field['name'] }}" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $createValue }}</textarea>
                            @elseif ($field['type'] === 'select')
                                <select name="{{ $field['name'] }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">Pilih {{ $field['label'] }}</option>
                                    @foreach ($field['options'] as $value => $label)
                                        <option value="{{ $value }}" @selected($createValue === (string) $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            @elseif ($field['type'] === 'image')
                                <input
                                    type="file"
                                    name="{{ $field['name'] }}"
                                    accept="image/*"
                                    class="mt-1 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-emerald-800 hover:file:bg-emerald-100"
                                >
                            @else
                                <input
                                    type="{{ $field['type'] }}"
                                    name="{{ $field['name'] }}"
                                    value="{{ $field['type'] === 'time' && $createValue ? \Illuminate\Support\Str::substr($createValue, 0, 5) : $createValue }}"
                                    class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700"
                                >
                            @endif

                            @error($field['name'])
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    <div class="lg:col-span-2">
                        <button type="submit" class="inline-flex items-center rounded-full bg-emerald-700 px-5 py-2.5 text-white shadow-sm shadow-emerald-700/15 transition hover:bg-emerald-800">
                            Simpan {{ $config['label'] }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="rounded-3xl border border-emerald-900/8 bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] lg:p-8">
                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Daftar Data</p>
                        <h3 class="mt-2 text-xl font-semibold text-slate-900">{{ $config['label'] }}</h3>
                        <p class="mt-2 text-sm text-slate-500">Edit langsung pada kartu lalu simpan perubahan.</p>
                    </div>
                    <span class="rounded-full bg-[#f8fbf9] px-4 py-2 text-sm font-medium text-emerald-800">Total: {{ $items->count() }}</span>
                </div>

                <div class="mt-6 space-y-4">
                    @forelse ($items as $item)
                        <div class="rounded-2xl border border-emerald-900/10 bg-[#f8fbf9] p-5">
                            <form method="POST" action="{{ route('admin.content.update', [$type, $item->id]) }}" enctype="multipart/form-data" class="grid gap-4 lg:grid-cols-2">
                                @csrf
                                @method('PUT')

                                @foreach ($config['fields'] as $field)
                                    @php
                                        $editValue = old($field['name'], $item->{$field['name']});
                                        if ($field['type'] === 'time' && $editValue) {
                                            $editValue = \Illuminate\Support\Str::substr($editValue, 0, 5);
                                        }
                                    @endphp
                                    <div class="{{ $field['type'] === 'textarea' || $field['type'] === 'image' ? 'lg:col-span-2' : '' }}">
                                        <label class="block text-xs font-semibold uppercase tracking-[0.2em] text-emerald-800">{{ $field['label'] }}</label>

                                        @if ($field['type'] === 'textarea')
                                            <textarea name="{{ $field['name'] }}" rows="3" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700">{{ $editValue }}</textarea>
                                        @elseif ($field['type'] === 'select')
                                            <select name="{{ $field['name'] }}" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700">
                                                <option value="">Pilih {{ $field['label'] }}</option>
                                                @foreach ($field['options'] as $value => $label)
                                                    <option value="{{ $value }}" @selected($editValue === (string) $value)>{{ $label }}</option>
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
                                                <div class="mt-2 mb-3">
                                                    <img src="{{ $currentImage }}" alt="{{ $field['label'] }}" class="h-36 w-36 rounded-2xl object-cover border border-emerald-900/10 shadow-sm">
                                                </div>
                                                <label class="mb-2 flex items-center gap-2 text-sm text-slate-600">
                                                    <input type="checkbox" name="remove_{{ $field['name'] }}" value="1" class="rounded border-slate-300 text-red-600 focus:ring-red-500">
                                                    Hapus foto lama saat simpan
                                                </label>
                                            @endif
                                            <label class="block text-sm font-medium text-slate-700">Ganti foto</label>
                                            <input
                                                type="file"
                                                name="{{ $field['name'] }}"
                                                accept="image/*"
                                                class="mt-1 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-emerald-800 hover:file:bg-emerald-100"
                                            >
                                            <p class="mt-2 text-xs text-slate-500">Unggah file baru untuk mengganti foto yang ada. Centang hapus jika ingin mengosongkan foto.</p>
                                        @else
                                            <input
                                                type="{{ $field['type'] }}"
                                                name="{{ $field['name'] }}"
                                                value="{{ $editValue }}"
                                                class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus:border-emerald-700 focus:ring-emerald-700"
                                            >
                                        @endif
                                    </div>
                                @endforeach

                                <div class="lg:col-span-2 flex items-center gap-3 pt-2">
                                    <button type="submit" class="inline-flex items-center rounded-full bg-emerald-700 px-5 py-2.5 text-white shadow-sm shadow-emerald-700/15 transition hover:bg-emerald-800">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('admin.content.destroy', [$type, $item->id]) }}" class="mt-3" onsubmit="return confirm('Hapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center rounded-full border border-red-200 bg-white px-4 py-2 text-red-600 transition hover:border-red-300 hover:bg-red-50">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-slate-500">Belum ada data {{ strtolower($config['label']) }}.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>