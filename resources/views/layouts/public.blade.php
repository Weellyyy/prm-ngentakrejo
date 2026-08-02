<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'PRM Ngentakrejo') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800">
    <div class="min-h-screen">
        <header class="bg-slate-950 text-white sticky top-0 z-50 shadow-lg shadow-slate-950/20">
            <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <a href="{{ route('home') }}" class="text-xl font-bold tracking-wide">
                    PRM Ngentakrejo
                </a>
                <nav class="flex flex-wrap gap-2 text-sm">
                    <a href="{{ route('home') }}" class="px-3 py-2 rounded-full bg-white/10 hover:bg-white/20">Beranda</a>
                    <a href="{{ route('profil-prm') }}" class="px-3 py-2 rounded-full bg-white/10 hover:bg-white/20">Profil PRM</a>
                    <a href="{{ route('agenda') }}" class="px-3 py-2 rounded-full bg-white/10 hover:bg-white/20">Agenda</a>
                    <a href="{{ route('informasi-prm') }}" class="px-3 py-2 rounded-full bg-white/10 hover:bg-white/20">Informasi PRM</a>
                    <a href="{{ route('ruang-iklan') }}" class="px-3 py-2 rounded-full bg-white/10 hover:bg-white/20">Ruang Iklan</a>
                    <a href="{{ route('donasi') }}" class="px-3 py-2 rounded-full bg-white/10 hover:bg-white/20">Donasi</a>
                    <a href="{{ route('program-kerja') }}" class="px-3 py-2 rounded-full bg-white/10 hover:bg-white/20">Program Kerja</a>
                    <a href="{{ route('media-dakwah') }}" class="px-3 py-2 rounded-full bg-white/10 hover:bg-white/20">Media Dakwah</a>
                </nav>
            </div>
        </header>

        @yield('content')
    </div>
</body>
</html>