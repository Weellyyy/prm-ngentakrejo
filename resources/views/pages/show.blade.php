@extends('layouts.public')

@section('content')
    <header class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-[#1e5d46] text-white">
        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-20">
            <p class="text-sm uppercase tracking-[0.3em] text-[#f1d58a]">PRM Ngentakrejo</p>
            <h1 class="mt-4 max-w-3xl text-4xl lg:text-5xl font-bold leading-tight">{{ $pageTitle }}</h1>
            <p class="mt-4 max-w-3xl text-lg text-emerald-50/85">{{ $pageDescription }}</p>
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
                        @foreach ($section['items'] as $item)
                            <p>{{ $item }}</p>
                        @endforeach
                    </div>
                @elseif ($section['type'] === 'cards')
                    @php
                        $isPengurusSection = $section['title'] === 'Daftar Pengurus';
                    @endphp
                    <div class="mt-6 grid gap-4 {{ $isPengurusSection ? 'md:grid-cols-2' : 'md:grid-cols-2 xl:grid-cols-3' }}">
                        @foreach ($section['items'] as $item)
                            <article class="rounded-2xl border border-emerald-950/10 bg-[#f8fbf9] p-5 transition hover:-translate-y-0.5 hover:border-emerald-700/20 hover:shadow-sm {{ $isPengurusSection ? 'md:flex md:items-center md:gap-5' : '' }}">
                                @if (!empty($item['image']))
                                    <div class="{{ $isPengurusSection ? 'md:w-36 md:shrink-0' : '' }}">
                                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="mb-4 {{ $isPengurusSection ? 'md:mb-0 h-36 w-full md:h-40 md:w-36' : 'h-44 w-full' }} rounded-xl object-cover">
                                    </div>
                                @endif
                                <div class="{{ $isPengurusSection ? 'flex-1' : '' }}">
                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#b9922e]">{{ $item['meta'] ?? 'PRM' }}</p>
                                    <h3 class="mt-3 text-lg font-semibold text-slate-900">{{ $item['title'] }}</h3>
                                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $item['description'] ?? 'Belum ada deskripsi.' }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>
        @endforeach
    </main>
@endsection