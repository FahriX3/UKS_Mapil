@extends('layouts.app')
@section('title', 'Edit Siswa')
@section('subtitle', 'Perbarui data siswa')

@section('content')
<div class="mx-auto max-w-lg">
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/60">
        <form method="POST" action="{{ route('students.update', $student) }}">
            @csrf @method('PUT')
            <div class="space-y-5">
                <div>
                    <label for="nis" class="mb-1.5 block text-sm font-medium text-slate-700">NIS</label>
                    <input type="text" id="nis" name="nis" value="{{ old('nis', $student->nis) }}" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
                    @error('nis') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="nama" class="mb-1.5 block text-sm font-medium text-slate-700">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $student->nama) }}" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
                    @error('nama') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="kelas_id" class="mb-1.5 block text-sm font-medium text-slate-700">Kelas</label>
                    <select id="kelas_id" name="kelas_id" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
                        @foreach($kelasList as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id', $student->kelas_id) == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                        @endforeach
                    </select>
                    @error('kelas_id') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">Jenis Kelamin</label>
                    <div class="flex gap-4">
                        <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-300 px-4 py-3 text-sm transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 has-[:checked]:ring-2 has-[:checked]:ring-emerald-500/20 flex-1">
                            <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $student->jenis_kelamin) === 'L' ? 'checked' : '' }} required class="text-emerald-500 focus:ring-emerald-500/25">
                            <span>Laki-laki</span>
                        </label>
                        <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-300 px-4 py-3 text-sm transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 has-[:checked]:ring-2 has-[:checked]:ring-emerald-500/20 flex-1">
                            <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', $student->jenis_kelamin) === 'P' ? 'checked' : '' }} class="text-emerald-500 focus:ring-emerald-500/25">
                            <span>Perempuan</span>
                        </label>
                    </div>
                    @error('jenis_kelamin') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('students.index') }}" class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition-colors hover:bg-slate-50">Batal</a>
                <button type="submit" class="flex-1 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/25 transition-all hover:from-emerald-600 hover:to-teal-600 active:scale-[0.98]">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection
