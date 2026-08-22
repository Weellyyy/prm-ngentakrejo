@extends('layouts.public')

@section('content')
    <header class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-[#1e5d46] text-white">
        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-20">
            <p class="text-sm uppercase tracking-[0.3em] text-[#f1d58a]">PRM Ngentakrejo</p>
            <h1 class="mt-4 max-w-3xl text-4xl lg:text-5xl font-bold leading-tight">Media Dakwah</h1>
            <p class="mt-4 max-w-3xl text-lg text-emerald-50/85">Artikel, ringkasan, dan konten dakwah terbaru.</p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-12 space-y-8">
        <div class="rounded-3xl border border-emerald-900/8 bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] lg:p-8">
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
                        @forelse ($items as $index => $item)
                            @php
                                // Default colors and icons
                                $badgeColor = 'bg-emerald-100 text-emerald-800 border-emerald-200';
                                $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>';
                                
                                if ($item['jenis_media'] === 'video') {
                                    $badgeColor = 'bg-purple-100 text-purple-800 border-purple-200';
                                    $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>';
                                } elseif ($item['jenis_media'] === 'audio') {
                                    $badgeColor = 'bg-amber-100 text-amber-800 border-amber-200';
                                    $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" /></svg>';
                                } elseif ($item['jenis_media'] === 'infografis') {
                                    $badgeColor = 'bg-blue-100 text-blue-800 border-blue-200';
                                    $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>';
                                }
                            @endphp
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 align-top">
                                    <div class="flex items-start gap-4">
                                        @php
                                            $thumbnail = null;
                                            if ($item['jenis_media'] !== 'audio') {
                                                $thumbnail = $item['file_media'] ?: $item['gambar'];
                                            } else {
                                                $thumbnail = $item['gambar'];
                                            }
                                        @endphp
                                        
                                        @if($thumbnail)
                                            <img src="{{ $thumbnail }}" alt="{{ $item['title'] }}" class="h-16 w-24 object-cover rounded-lg shadow-sm shrink-0">
                                        @else
                                            <div class="h-16 w-24 bg-emerald-900 rounded-lg flex items-center justify-center shadow-sm text-white relative overflow-hidden shrink-0">
                                                @if($item['jenis_media'] === 'video')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                @elseif($item['jenis_media'] === 'audio')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" /></svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3m0 0l3-3m-3 3V8" /></svg>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="min-w-0">
                                            <h4 class="font-semibold text-slate-900 leading-tight">{{ $item['title'] }}</h4>
                                            <p class="text-xs text-slate-400 mt-1">{{ $item['date'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-top text-center">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg border text-xs font-medium {{ $badgeColor }}">
                                        {!! $icon !!}
                                        {{ ucfirst($item['jenis_media'] ?? 'Artikel') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 align-top">
                                    @if ($item['jenis_media'] === 'audio' && $item['file_media'])
                                        <audio controls class="h-10 w-full max-w-[200px] rounded-full bg-slate-100">
                                            <source src="{{ $item['file_media'] }}" type="audio/mpeg">
                                            Browser tidak support audio.
                                        </audio>
                                    @elseif ($item['jenis_media'] === 'video' && $item['isi'])
                                        <a href="{{ $item['isi'] }}" target="_blank" class="text-emerald-700 hover:underline inline-flex items-center gap-1 font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                            {{ Str::limit($item['isi'], 30) }}
                                        </a>
                                    @elseif ($item['jenis_media'] === 'infografis' && $item['isi'])
                                        <div class="text-sm text-slate-600 line-clamp-2 max-w-sm">
                                            {{ strip_tags($item['isi']) }}
                                        </div>
                                    @elseif ($item['jenis_media'] === 'infografis' && $item['file_media'])
                                        <span class="inline-flex items-center gap-1.5 text-slate-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            Gambar Infografis
                                        </span>
                                    @else
                                        <div class="text-sm text-slate-600 line-clamp-2 max-w-sm">
                                            {{ strip_tags($item['isi']) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-top text-right">
                                    @if ($item['jenis_media'] === 'video' && $item['isi'])
                                        <a href="{{ $item['isi'] }}" target="_blank" class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-300 text-slate-700 bg-white hover:bg-slate-50 transition text-sm font-medium">
                                            Tonton
                                        </a>
                                    @elseif ($item['jenis_media'] !== 'audio')
                                        <button type="button" onclick="openMediaModal('modal-media-{{ $index }}')" class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-300 text-slate-700 bg-white hover:bg-slate-50 transition text-sm font-medium">
                                            Lihat
                                        </button>
                                    @endif
                                </td>
                            </tr>
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
    </main>

    {{-- MODALS --}}
    @foreach ($items as $index => $item)
        @if ($item['jenis_media'] !== 'audio' && $item['jenis_media'] !== 'video')
            <div id="modal-media-{{ $index }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 p-4 transition-opacity backdrop-blur-sm" onclick="if(event.target === this) closeMediaModal('modal-media-{{ $index }}')">
                <div class="w-full max-w-3xl max-h-[90vh] overflow-y-auto rounded-3xl bg-white p-6 shadow-2xl lg:p-8 relative">
                    <button type="button" onclick="closeMediaModal('modal-media-{{ $index }}')" class="absolute top-6 right-6 inline-flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-slate-500 transition hover:bg-slate-200 hover:text-slate-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    
                    <div class="pr-10">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg border text-xs font-medium bg-slate-100 text-slate-700 border-slate-200 mb-4">
                            {{ ucfirst($item['jenis_media'] ?? 'Artikel') }}
                        </span>
                        <h3 class="text-2xl font-bold text-slate-900 leading-tight">{{ $item['title'] }}</h3>
                        <p class="text-sm text-slate-500 mt-2">{{ $item['date'] }}</p>
                    </div>

                    <div class="mt-8 prose prose-slate max-w-none text-slate-700">
                        @if ($item['jenis_media'] === 'infografis' && $item['file_media'])
                            <img src="{{ $item['file_media'] }}" alt="{{ $item['title'] }}" class="w-full h-auto rounded-xl shadow-sm border border-slate-200 mb-6">
                        @elseif ($item['gambar'])
                            <img src="{{ $item['gambar'] }}" alt="{{ $item['title'] }}" class="w-full max-h-[400px] object-cover rounded-xl shadow-sm border border-slate-200 mb-6">
                        @endif

                        @if ($item['isi'])
                            <div class="leading-relaxed">
                                {!! nl2br(e($item['isi'])) !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <script>
        function openMediaModal(id) {
            const modal = document.getElementById(id);
            if(modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            }
        }

        function closeMediaModal(id) {
            const modal = document.getElementById(id);
            if(modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('[id^="modal-media-"]').forEach(function (modal) {
                    if (!modal.classList.contains('hidden')) {
                        closeMediaModal(modal.id);
                    }
                });
            }
        });
    </script>
@endsection
