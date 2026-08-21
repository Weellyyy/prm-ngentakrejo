<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'PRM Ngentakrejo') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/muhammadiyah.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f6faf7] text-slate-800 antialiased">
    <div class="min-h-screen flex flex-col" x-data="{ open: false }">
        <header class="sticky top-0 z-50 border-b border-emerald-900/10 bg-white/90 backdrop-blur-xl">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex items-center justify-between gap-4">
                    {{-- Logo --}}
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-lg font-bold tracking-wide text-emerald-950 shrink-0">
                        <img src="{{ asset('images/muhammadiyah.png') }}" alt="Logo Muhammadiyah" class="h-11 w-11 object-contain">
                        <span class="block text-base font-bold text-slate-900 whitespace-nowrap">PRM Ngentakrejo</span>
                    </a>

                    {{-- Desktop nav --}}
                    <nav class="hidden xl:flex xl:flex-wrap xl:items-center xl:justify-end xl:gap-2 text-sm">
                        <a href="{{ route('home') }}"
                            class="whitespace-nowrap rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('home') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Beranda
                        </a>
                        <a href="{{ route('profil-prm') }}"
                            class="whitespace-nowrap rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('profil-prm') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Profil PRM
                        </a>
                        <a href="{{ route('agenda') }}"
                            class="whitespace-nowrap rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('agenda') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Agenda
                        </a>
                        <a href="{{ route('informasi-prm') }}"
                            class="whitespace-nowrap rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('informasi-prm') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Informasi PRM
                        </a>
                        <a href="{{ route('ruang-iklan') }}"
                            class="whitespace-nowrap rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('ruang-iklan') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Ruang Iklan
                        </a>
                        <a href="{{ route('donasi') }}"
                            class="whitespace-nowrap rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('donasi') || request()->routeIs('donasi.form') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Donasi
                        </a>
                        <a href="{{ route('program-kerja') }}"
                            class="whitespace-nowrap rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('program-kerja') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Program Kerja
                        </a>
                        <a href="{{ route('media-dakwah') }}"
                            class="whitespace-nowrap rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('media-dakwah') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                            Media Dakwah
                        </a>
                    </nav>

                    {{-- Mobile/tablet hamburger toggle --}}
                    <button @click="open = ! open" class="xl:hidden inline-flex items-center justify-center rounded-full border border-emerald-900/10 bg-white p-2.5 text-slate-500 hover:border-emerald-700 hover:text-emerald-800 transition shrink-0">
                        <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Mobile/tablet menu --}}
            <div x-show="open" x-cloak @click.outside="open = false" class="xl:hidden border-t border-emerald-900/10 bg-white">
                <nav class="max-w-7xl mx-auto px-6 py-4 flex flex-col gap-2 text-sm">
                    <a href="{{ route('home') }}"
                        class="rounded-xl border px-4 py-2.5 font-medium transition {{ request()->routeIs('home') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700' }}">
                        Beranda
                    </a>
                    <a href="{{ route('profil-prm') }}"
                        class="rounded-xl border px-4 py-2.5 font-medium transition {{ request()->routeIs('profil-prm') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700' }}">
                        Profil PRM
                    </a>
                    <a href="{{ route('agenda') }}"
                        class="rounded-xl border px-4 py-2.5 font-medium transition {{ request()->routeIs('agenda') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700' }}">
                        Agenda
                    </a>
                    <a href="{{ route('informasi-prm') }}"
                        class="rounded-xl border px-4 py-2.5 font-medium transition {{ request()->routeIs('informasi-prm') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700' }}">
                        Informasi PRM
                    </a>
                    <a href="{{ route('ruang-iklan') }}"
                        class="rounded-xl border px-4 py-2.5 font-medium transition {{ request()->routeIs('ruang-iklan') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700' }}">
                        Ruang Iklan
                    </a>
                    <a href="{{ route('donasi') }}"
                        class="rounded-xl border px-4 py-2.5 font-medium transition {{ request()->routeIs('donasi') || request()->routeIs('donasi.form') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700' }}">
                        Donasi
                    </a>
                    <a href="{{ route('program-kerja') }}"
                        class="rounded-xl border px-4 py-2.5 font-medium transition {{ request()->routeIs('program-kerja') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700' }}">
                        Program Kerja
                    </a>
                    <a href="{{ route('media-dakwah') }}"
                        class="rounded-xl border px-4 py-2.5 font-medium transition {{ request()->routeIs('media-dakwah') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700' }}">
                        Media Dakwah
                    </a>
                </nav>
            </div>
        </header>

        <div class="flex-1">
            @yield('content')
        </div>

        {{-- Footer --}}
        <footer class="mt-16 border-t border-emerald-900/10 bg-white">
            <div class="max-w-7xl mx-auto px-6 py-10">
                <div class="flex flex-col gap-8 md:flex-row md:items-center md:justify-between">

                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/muhammadiyah.png') }}" alt="Logo Muhammadiyah" class="h-12 w-12 object-contain">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Ngentakrejo</p>
                            <p class="text-base font-bold text-slate-900">PRM Ngentakrejo</p>
                        </div>
                    </div>

                    <div>
                        <p class="mb-3 text-sm font-semibold text-slate-700">Ikuti Kami</p>
                        <div class="flex items-center gap-3">
                            <a href="https://www.instagram.com/prmngentakrejo/" target="_blank" rel="noopener noreferrer" aria-label="Instagram PRM Ngentakrejo" class="group flex h-11 w-11 items-center justify-center rounded-full border border-emerald-900/10 bg-white text-slate-600 shadow-sm transition hover:-translate-y-1 hover:border-emerald-700 hover:bg-emerald-50 hover:text-emerald-700">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                    <rect x="3" y="3" width="18" height="18" rx="5"></rect>
                                    <circle cx="12" cy="12" r="4"></circle>
                                    <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"></circle>
                                </svg>
                            </a>

                            <a href="https://www.youtube.com/@prm_ngentakrejo" target="_blank" rel="noopener noreferrer" aria-label="YouTube PRM Ngentakrejo" class="group flex h-11 w-11 items-center justify-center rounded-full border border-emerald-900/10 bg-white text-slate-600 shadow-sm transition hover:-translate-y-1 hover:border-emerald-700 hover:bg-emerald-50 hover:text-emerald-700">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                    <path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.6 15.9V8.1l6.5 3.9-6.5 3.9Z"></path>
                                </svg>
                            </a>

                            <a href="https://www.facebook.com/prm.ngentakrejo" target="_blank" rel="noopener noreferrer" aria-label="Facebook PRM Ngentakrejo" class="group flex h-11 w-11 items-center justify-center rounded-full border border-emerald-900/10 bg-white text-slate-600 shadow-sm transition hover:-translate-y-1 hover:border-emerald-700 hover:bg-emerald-50 hover:text-emerald-700">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                    <path d="M14 8h3V4h-3c-3.3 0-5 2-5 5v3H6v4h3v8h4v-8h3.5l.5-4H13V9c0-.7.3-1 1-1Z"></path>
                                </svg>
                            </a>

                            <a href="https://www.tiktok.com/@prm.ngentakrejo" target="_blank" rel="noopener noreferrer" aria-label="TikTok PRM Ngentakrejo" class="group flex h-11 w-11 items-center justify-center rounded-full border border-emerald-900/10 bg-white text-slate-600 shadow-sm transition hover:-translate-y-1 hover:border-emerald-700 hover:bg-emerald-50 hover:text-emerald-700">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                    <path d="M19.3 7.1a5.9 5.9 0 0 1-3.6-1.2v7.4a5.7 5.7 0 1 1-4.9-5.6v3.1a2.7 2.7 0 1 0 1.9 2.6V2h3.1a5.9 5.9 0 0 0 3.5 2.9v2.2Z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-8 border-t border-emerald-900/10 pt-5 text-center">
                    <p class="text-sm text-slate-500">&copy; {{ date('Y') }} PRM Ngentakrejo. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>