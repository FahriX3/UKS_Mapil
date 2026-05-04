@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen">
    {{-- Left Panel - Decorative --}}
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-slate-900 via-emerald-900 to-teal-900 relative overflow-hidden items-center justify-center p-12">
        {{-- Decorative circles --}}
        <div class="absolute -top-24 -left-24 h-96 w-96 rounded-full bg-emerald-500/10 blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 h-96 w-96 rounded-full bg-teal-500/10 blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 h-64 w-64 -translate-x-1/2 -translate-y-1/2 rounded-full bg-emerald-400/5 blur-2xl"></div>

        <div class="relative z-10 text-center">
            <div class="mx-auto mb-8 flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 shadow-2xl shadow-emerald-500/30">
                <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"></path>
                </svg>
            </div>
            <h1 class="mb-4 text-4xl font-bold text-white">UKS Management</h1>
            <p class="text-lg text-emerald-200/80">Sistem Manajemen Unit Kesehatan Sekolah</p>
            <div class="mt-8 flex items-center justify-center gap-8 text-emerald-300/60">
                <div class="text-center">
                    <div class="text-2xl font-bold text-white">📋</div>
                    <p class="mt-1 text-xs">Catat Kunjungan</p>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-white">💊</div>
                    <p class="mt-1 text-xs">Kelola Obat</p>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-white">📊</div>
                    <p class="mt-1 text-xs">Laporan</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Panel - Login Form --}}
    <div class="flex w-full items-center justify-center bg-slate-50 p-8 lg:w-1/2">
        <div class="w-full max-w-md">
            <div class="lg:hidden mb-8 text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 shadow-lg">
                    <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-slate-800">UKS Management</h1>
            </div>

            <div class="rounded-2xl bg-white p-8 shadow-xl shadow-slate-200/50 ring-1 ring-slate-200/50">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-slate-800">Selamat Datang 👋</h2>
                    <p class="mt-1 text-sm text-slate-500">Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 transition-all duration-200 placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10"
                            placeholder="email@sekolah.com">
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 transition-all duration-200 placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10"
                            placeholder="••••••••">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 rounded border-slate-300 text-emerald-500 focus:ring-emerald-500/25">
                        <label for="remember" class="ml-2 text-sm text-slate-600">Ingat saya</label>
                    </div>

                    <button type="submit"
                        class="w-full rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-500/25 transition-all duration-200 hover:from-emerald-600 hover:to-teal-600 hover:shadow-xl hover:shadow-emerald-500/30 active:scale-[0.98]">
                        Masuk
                    </button>
                </form>

                <div class="mt-6 rounded-xl bg-slate-50 p-4 text-xs text-slate-500">
                    <p class="font-semibold text-slate-600 mb-2">Demo Akun:</p>
                    <div class="space-y-1">
                        <p><span class="font-medium">Admin:</span> admin@uks.com / password</p>
                        <p><span class="font-medium">Petugas:</span> petugas@uks.com / password</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
