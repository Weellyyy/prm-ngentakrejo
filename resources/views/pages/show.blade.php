@extends('layouts.public')

@section('content')
    <header class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-[#1e5d46] text-white">
    <div class="max-w-7xl mx-auto px-6 py-16 lg:py-20">
        <p class="text-sm uppercase tracking-[0.3em] text-[#f1d58a]">PRM Ngentakrejo</p>
        <h1 class="mt-4 max-w-3xl text-4xl lg:text-5xl font-bold leading-tight">{{ $pageTitle }}</h1>
        <p class="mt-4 max-w-3xl text-lg text-emerald-50/85">{{ $pageDescription }}</p>

        @if (request()->routeIs('donasi'))
            <a href="{{ route('donasi.form') }}" class="mt-6 inline-flex items-center gap-2 rounded-full bg-[#d9b75f] px-6 py-3 text-sm font-semibold text-emerald-950 shadow-sm shadow-[#d9b75f]/20 transition hover:bg-[#cfac4d]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Kirim donasi
            </a>
        @endif
    </div>
</header>

    <main class="max-w-7xl mx-auto px-6 py-12 space-y-8">
        @foreach ($sections as $section)
            <section class="rounded-3xl border border-emerald-900/8 bg-white p-6 shadow-[0_18px_40px_rgba(15,23,42,0.05)] lg:p-8">
                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">{{ $section['title'] }}</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-900">{{ $section['title'] }}</h2>
                        @if (!empty($section['description']))
                            <p class="mt-2 text-slate-600">{{ $section['description'] }}</p>
                        @endif
                    </div>
                </div>

                @if ($section['type'] === 'text')
                    <div class="mt-6 space-y-4 text-slate-600 leading-relaxed">
                        @if (!empty($section['image']))
                            <img src="{{ $section['image'] }}" alt="{{ $section['title'] }}" class="w-full max-h-80 object-cover rounded-2xl mb-4">
                        @endif
                        @foreach ($section['items'] as $item)
                            <p>{{ $item }}</p>
                        @endforeach
                    </div>
                @elseif ($section['type'] === 'list')
                    <ul class="mt-6 space-y-2 text-slate-600 leading-relaxed list-disc list-inside">
                        @foreach ($section['items'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                @elseif ($section['type'] === 'map')
                    @if (!empty($section['embedUrl']))
                        <div class="mt-6 overflow-hidden rounded-2xl border border-emerald-900/10">
                            <iframe
                                src="{{ $section['embedUrl'] }}"
                                class="h-80 w-full"
                                style="border:0;"
                                allowfullscreen
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    @else
                        <p class="mt-6 text-slate-500">Peta lokasi belum diatur.</p>
                    @endif
                @elseif ($section['type'] === 'cards')
                    @php
                        $isPengurusSection = $section['title'] === 'Daftar Pengurus';
                    @endphp
                    <div class="mt-6 grid gap-4 {{ $isPengurusSection ? 'md:grid-cols-2' : 'md:grid-cols-2 xl:grid-cols-3' }}">
                        @foreach ($section['items'] as $item)
                            @php
                                $cardTag = !empty($item['linkUrl']) ? 'a' : 'div';
                            @endphp
                            <{{ $cardTag }}
                                @if (!empty($item['linkUrl']))
                                    href="{{ $item['linkUrl'] }}" target="_blank" rel="noopener noreferrer"
                                @endif
                                class="block rounded-2xl border border-emerald-950/10 bg-[#f8fbf9] p-5 transition hover:-translate-y-0.5 hover:border-emerald-700/20 hover:shadow-sm {{ $isPengurusSection ? 'md:flex md:items-center md:gap-5' : '' }}"
                            >
                                @if (!empty($item['image']))
                                    <div class="{{ $isPengurusSection ? 'md:w-36 md:shrink-0' : '' }}">
                                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="mb-4 {{ $isPengurusSection ? 'md:mb-0 h-36 w-full md:h-40 md:w-36' : 'h-44 w-full' }} rounded-xl object-cover">
                                    </div>
                                @endif
                                <div class="{{ $isPengurusSection ? 'flex-1' : '' }}">
                                    @if (!empty($item['status']))
                                        @php
                                            $statusColor = match ($item['status']) {
                                                'Berlangsung' => 'bg-amber-100 text-amber-800',
                                                'Selesai' => 'bg-slate-200 text-slate-600',
                                                default => 'bg-emerald-100 text-emerald-800', // Akan Datang
                                            };
                                        @endphp
                                        <span class="inline-block rounded-full px-3 py-1 text-xs font-semibold {{ $statusColor }}">{{ $item['status'] }}</span>
                                    @endif

                                    <p class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-[#b9922e]">{{ $item['meta'] ?? 'PRM' }}</p>
                                    <h3 class="mt-3 text-lg font-semibold text-slate-900">{{ $item['title'] }}</h3>

                                    @if ($isPengurusSection)
                                        @if (!empty($item['bidang']))
                                            <p class="mt-1 text-xs text-slate-500">Bidang: {{ $item['bidang'] }}</p>
                                        @endif
                                        @if (!empty($item['periode']))
                                            <p class="mt-1 text-xs text-slate-500">Periode: {{ $item['periode'] }}</p>
                                        @endif
                                        @if (!empty($item['kontak']))
                                            <p class="mt-1 text-xs text-slate-500">Kontak: {{ $item['kontak'] }}</p>
                                        @endif
                                    @endif

                                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $item['description'] ?? 'Belum ada deskripsi.' }}</p>

                                    @if (!empty($item['jumlah']))
                                        <p class="mt-3 text-base font-semibold text-emerald-700">{{ $item['jumlah'] }}</p>
                                    @endif
                                    @if (!empty($item['metode']))
                                        <p class="mt-1 text-xs text-slate-500">Metode: {{ $item['metode'] }}</p>
                                    @endif

                                    @if (!empty($item['penanggungJawab']))
                                        <p class="mt-3 text-xs font-medium text-slate-500">PJ/Kontak: {{ $item['penanggungJawab'] }}</p>
                                    @endif
                                </div>
                            </{{ $cardTag }}>
                        @endforeach
                    </div>
                @endif
            </section>
        @endforeach
    </main>
@endsection