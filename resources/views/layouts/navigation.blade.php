<nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-emerald-900/10 bg-white/90 backdrop-blur-xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            {{-- LOGO --}}
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-3 text-lg font-bold tracking-wide text-emerald-950">
                    <img src="{{ asset('images/muhammadiyah.png') }}" alt="Logo Muhammadiyah" class="h-11 w-11 object-contain">
                    <span>
                        <span class="block text-sm font-semibold uppercase tracking-[0.25em] text-emerald-700">Admin</span>
                        <span class="block text-base font-bold text-slate-900">PRM Ngentakrejo</span>
                    </span>
                </a>

                {{-- Mobile toggle --}}
                <button @click="open = ! open" class="lg:hidden inline-flex items-center justify-center rounded-full border border-emerald-900/10 bg-white p-2.5 text-slate-500 hover:border-emerald-700 hover:text-emerald-800 transition">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- NAV + USER (desktop) --}}
            <div class="hidden lg:flex lg:flex-col lg:items-end lg:gap-3">
                <nav class="flex flex-wrap justify-end gap-2 text-sm">
                    <a href="{{ route('dashboard') }}"
                        class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('dashboard') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.profil-prm.index') }}"
                        class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('admin.profil-prm.*') ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                        Profil PRM
                    </a>
                    <a href="{{ route('admin.content.index', ['type' => 'pengurus']) }}"
                        class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('admin.content.*') && request()->route('type') === 'pengurus' ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                        Pengurus
                    </a>
                    <a href="{{ route('admin.content.index', ['type' => 'agenda']) }}"
                        class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('admin.content.*') && request()->route('type') === 'agenda' ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                        Agenda
                    </a>
                    <a href="{{ route('admin.content.index', ['type' => 'program-kerja']) }}"
                        class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('admin.content.*') && request()->route('type') === 'program-kerja' ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                        Program Kerja
                    </a>
                    <a href="{{ route('admin.content.index', ['type' => 'media-dakwah']) }}"
                        class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('admin.content.*') && request()->route('type') === 'media-dakwah' ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                        Media Dakwah
                    </a>
                    <a href="{{ route('admin.content.index', ['type' => 'ruang-iklan']) }}"
                        class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('admin.content.*') && request()->route('type') === 'ruang-iklan' ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                        Ruang Iklan
                    </a>
                    <a href="{{ route('admin.content.index', ['type' => 'donasi']) }}"
                        class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('admin.content.*') && request()->route('type') === 'donasi' ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                        Donasi
                    </a>
                    <a href="{{ route('admin.content.index', ['type' => 'bidang']) }}"
                        class="rounded-full border px-4 py-2 font-medium transition {{ request()->routeIs('admin.content.*') && request()->route('type') === 'bidang' ? 'border-emerald-700 bg-emerald-50 text-emerald-800' : 'border-emerald-900/10 bg-white text-slate-700 hover:border-emerald-700 hover:text-emerald-800' }}">
                        Bidang
                    </a>
                </nav>

                <div class="flex items-center gap-2">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 rounded-full border border-emerald-900/10 bg-white px-4 py-2 text-sm font-medium text-slate-600 shadow-sm transition hover:border-emerald-700 hover:text-emerald-800 focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profil Akun') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center rounded-full border border-red-200 bg-white px-4 py-2 text-sm font-medium text-red-600 shadow-sm transition hover:border-red-300 hover:bg-red-50 hover:text-red-700 focus:outline-none">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden border-t border-emerald-900/10">
        <div class="px-4 py-3 space-y-1.5">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.profil-prm.index')" :active="request()->routeIs('admin.profil-prm.*')">
                {{ __('Profil PRM') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.content.index', ['type' => 'pengurus'])" :active="request()->routeIs('admin.content.*') && request()->route('type') === 'pengurus'">
                {{ __('Pengurus') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.content.index', ['type' => 'agenda'])" :active="request()->routeIs('admin.content.*') && request()->route('type') === 'agenda'">
                {{ __('Agenda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.content.index', ['type' => 'program-kerja'])" :active="request()->routeIs('admin.content.*') && request()->route('type') === 'program-kerja'">
                {{ __('Program Kerja') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.content.index', ['type' => 'media-dakwah'])" :active="request()->routeIs('admin.content.*') && request()->route('type') === 'media-dakwah'">
                {{ __('Media Dakwah') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.content.index', ['type' => 'ruang-iklan'])" :active="request()->routeIs('admin.content.*') && request()->route('type') === 'ruang-iklan'">
                {{ __('Ruang Iklan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.content.index', ['type' => 'donasi'])" :active="request()->routeIs('admin.content.*') && request()->route('type') === 'donasi'">
                {{ __('Donasi') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-3 border-t border-emerald-900/10 px-4">
            <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil Akun') }}
                </x-responsive-nav-link>

                <div class="border-t border-emerald-900/10 my-2"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            class="text-red-600 focus:text-red-700"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logout Admin') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>