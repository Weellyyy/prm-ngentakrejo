<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'PRM Ngentakrejo') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/muhammadiyah.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f6faf7] text-slate-800 antialiased">
    <div class="min-h-screen">
        <header class="sticky top-0 z-50 border-b border-emerald-900/10 bg-white/90 backdrop-blur-xl">
            <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-lg font-bold tracking-wide text-emerald-950">
                    <img src="{{ asset('images/muhammadiyah.png') }}" alt="Logo Muhammadiyah" class="h-11 w-11 object-contain">
                    <span>
                        <span class="block text-sm font-semibold uppercase tracking-[0.25em] text-emerald-700">Ngentakrejo</span>
                        <span class="block text-base font-bold text-slate-900">PRM Ngentakrejo</span>
                    </span>
                </a>

                <div class="flex flex-col gap-3 lg:items-end">
                    <nav class="flex flex-wrap gap-2 text-sm">
                        <a href="{{ route('home') }}"
                            class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('home') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Beranda
                        </a>
                        <a href="{{ route('profil-prm') }}"
                            class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('profil-prm') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Profil PRM
                        </a>
                        <a href="{{ route('agenda') }}"
                            class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('agenda') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Agenda
                        </a>
                        <a href="{{ route('informasi-prm') }}"
                            class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('informasi-prm') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Informasi PRM
                        </a>
                        <a href="{{ route('ruang-iklan') }}"
                            class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('ruang-iklan') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Ruang Iklan
                        </a>
                        <a href="{{ route('donasi') }}"
                            class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('donasi') || request()->routeIs('donasi.form') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Donasi
                        </a>
                        <a href="{{ route('program-kerja') }}"
                            class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('program-kerja') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Program Kerja
                        </a>
                        <a href="{{ route('media-dakwah') }}"
                            class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('media-dakwah') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Media Dakwah
                        </a>
                    </nav>

                    <div>
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-full bg-emerald-700 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-emerald-700/15 transition hover:bg-emerald-800">
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center rounded-full bg-[#d9b75f] px-4 py-2 text-sm font-semibold text-emerald-950 shadow-sm shadow-[#d9b75f]/20 transition hover:bg-[#cfac4d]">
                                Login Admin
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        @yield('content')
    </div>
</body>
</html>