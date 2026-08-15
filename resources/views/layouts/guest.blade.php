<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PRM Ngentakrejo') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/muhammadiyah.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#f6faf7]">
            <div class="mb-2">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <img src="{{ asset('images/muhammadiyah.png') }}" alt="Logo Muhammadiyah" class="h-14 w-14 object-contain">
                    <span>
                        <span class="block text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Ngentakrejo</span>
                        <span class="block text-lg font-bold text-slate-900">PRM Ngentakrejo</span>
                    </span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-[0_18px_40px_rgba(15,23,42,0.06)] overflow-hidden sm:rounded-3xl border border-emerald-900/8">
                {{ $slot }}
            </div>

            <p class="mt-6 text-xs text-slate-400">&copy; {{ date('Y') }} PRM Ngentakrejo. Panel khusus admin.</p>
        </div>
    </body>
</html>