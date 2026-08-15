<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Panel Admin</p>
        <h1 class="mt-2 text-xl font-semibold text-slate-900">Masuk ke Dashboard</h1>
        <p class="mt-1 text-sm text-slate-500">Silakan login menggunakan akun admin Anda.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="mt-1.5 block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm shadow-sm focus:border-emerald-700 focus:ring-emerald-700">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember"
                class="h-4 w-4 rounded border-slate-300 text-emerald-700 focus:ring-emerald-700">
            <label for="remember_me" class="ms-2 text-sm text-slate-600">Ingat saya</label>
        </div>

        <button type="submit" class="w-full rounded-full bg-emerald-700 px-5 py-3 text-sm font-semibold text-white shadow-sm shadow-emerald-700/15 transition hover:bg-emerald-800">
            Masuk
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('home') }}" class="text-sm font-medium text-slate-500 hover:text-emerald-700">
            &larr; Kembali ke beranda
        </a>
    </div>
</x-guest-layout>