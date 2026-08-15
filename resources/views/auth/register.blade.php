<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Panel Admin</p>
        <h1 class="mt-2 text-xl font-semibold text-slate-900">Buat Akun Admin</h1>
        <p class="mt-1 text-sm text-slate-500">Daftarkan akun baru untuk mengelola konten PRM.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Nama</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700">
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <button type="submit" class="w-full rounded-full bg-emerald-700 px-5 py-3 text-sm font-semibold text-white shadow-sm shadow-emerald-700/15 transition hover:bg-emerald-800">
            Daftar
        </button>
    </form>

    <div class="mt-6 text-center text-sm text-slate-500">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-medium text-emerald-700 hover:text-emerald-800">Masuk di sini</a>
    </div>
</x-guest-layout>