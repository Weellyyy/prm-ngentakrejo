<nav x-data="{ open: false }" class="border-b border-emerald-900/10 bg-white/90 backdrop-blur-xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2">
                        <img src="{{ asset('images/muhammadiyah.png') }}" alt="Logo Muhammadiyah" class="h-10 w-10 object-contain">
                        <span class="hidden sm:block text-sm font-semibold tracking-[0.2em] text-emerald-800">ADMIN</span>
                    </a>
                </div>

                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex sm:flex-wrap">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.profil-prm.index')" :active="request()->routeIs('admin.profil-prm.*')">
                        {{ __('Profil PRM') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.content.index', ['type' => 'pengurus'])" :active="request()->routeIs('admin.content.*') && request()->route('type') === 'pengurus'">
                        {{ __('Pengurus') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.content.index', ['type' => 'agenda'])" :active="request()->routeIs('admin.content.*') && request()->route('type') === 'agenda'">
                        {{ __('Agenda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.content.index', ['type' => 'program-kerja'])" :active="request()->routeIs('admin.content.*') && request()->route('type') === 'program-kerja'">
                        {{ __('Program Kerja') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.content.index', ['type' => 'media-dakwah'])" :active="request()->routeIs('admin.content.*') && request()->route('type') === 'media-dakwah'">
                        {{ __('Media Dakwah') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.content.index', ['type' => 'ruang-iklan'])" :active="request()->routeIs('admin.content.*') && request()->route('type') === 'ruang-iklan'">
                        {{ __('Ruang Iklan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.content.index', ['type' => 'donasi'])" :active="request()->routeIs('admin.content.*') && request()->route('type') === 'donasi'">
                        {{ __('Donasi') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-3 sm:ms-6">
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

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
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

        <div class="pt-4 pb-1 border-t border-emerald-900/10">
            <div class="px-4">
                <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil Akun') }}
                </x-responsive-nav-link>

                <div class="border-t border-emerald-900/10"></div>

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