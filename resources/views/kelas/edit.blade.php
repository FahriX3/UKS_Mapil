@extends('layouts.app')
@section('title', 'Edit Kelas')
@section('subtitle', 'Perbarui data kelas')

@section('content')
<div class="mx-auto max-w-lg">
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/60">
        <form method="POST" action="{{ route('kelas.update', $kelas) }}">
            @csrf @method('PUT')
            <div class="mb-5">
                <label for="nama" class="mb-1.5 block text-sm font-medium text-slate-700">Nama Kelas</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $kelas->nama) }}" required
                    class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
                @error('nama') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3">
                <a href="{{ route('kelas.index') }}" class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition-colors hover:bg-slate-50">Batal</a>
                <button type="submit" class="flex-1 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/25 transition-all hover:from-emerald-600 hover:to-teal-600 active:scale-[0.98]">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection
