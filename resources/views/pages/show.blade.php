@extends('layouts.public')

@section('content')
    <header class="bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-900 text-white">
        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-20">
            <p class="text-sm uppercase tracking-[0.3em] text-emerald-200">PRM Ngentakrejo</p>
            <h1 class="mt-4 text-4xl lg:text-5xl font-bold leading-tight">{{ $pageTitle }}</h1>
            <p class="mt-4 max-w-3xl text-lg text-slate-200">{{ $pageDescription }}</p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-12 space-y-8">
        @foreach ($sections as $section)
            <section class="bg-white rounded-3xl shadow-sm ring-1 ring-slate-200 p-6 lg:p-8">
                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">{{ $section['title'] }}</h2>
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
                    <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($section['items'] as $item)
                            <article class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700">{{ $item['meta'] ?? 'PRM' }}</p>
                                <h3 class="mt-3 text-lg font-semibold text-slate-900">{{ $item['title'] }}</h3>
                                <p class="mt-3 text-sm leading-6 text-slate-600">{{ $item['description'] ?? 'Belum ada deskripsi.' }}</p>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>
        @endforeach
    </main>
@endsection