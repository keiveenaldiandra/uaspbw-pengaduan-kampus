<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Selamat Datang! 👋</h2>
        <p class="text-slate-500 text-sm mt-1">Masuk untuk mengelola pengaduan kampusmu.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   placeholder="mahasiswa@kampus.ac.id"
                   class="w-full border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
            <input id="password" type="password" name="password" required
                   placeholder="••••••••"
                   class="w-full border {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600">
                <span class="text-sm text-slate-500">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Lupa password?</a>
            @endif
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition-colors shadow-sm mt-2">
            Masuk ke Akun
        </button>

        <p class="text-center text-sm text-slate-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar sekarang</a>
        </p>
    </form>
</x-guest-layout>
