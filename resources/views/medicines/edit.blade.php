@extends('layouts.app')
@section('title', 'Edit Obat')
@section('subtitle', 'Perbarui data obat')

@section('content')
<div class="mx-auto max-w-lg">
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/60">
        <form method="POST" action="{{ route('medicines.update', $medicine) }}">
            @csrf @method('PUT')
            <div class="space-y-5">
                <div>
                    <label for="nama_obat" class="mb-1.5 block text-sm font-medium text-slate-700">Nama Obat</label>
                    <input type="text" id="nama_obat" name="nama_obat" value="{{ old('nama_obat', $medicine->nama_obat) }}" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
                    @error('nama_obat') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="satuan" class="mb-1.5 block text-sm font-medium text-slate-700">Satuan</label>
                    <input type="text" id="satuan" name="satuan" value="{{ old('satuan', $medicine->satuan) }}" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
                    @error('satuan') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="rounded-xl bg-slate-50 p-4 ring-1 ring-slate-200">
                    <p class="text-sm text-slate-500">Stok saat ini: <span class="font-bold text-slate-800">{{ $medicine->stok }} {{ $medicine->satuan }}</span></p>
                    <p class="mt-1 text-xs text-slate-400">Untuk menambah stok, gunakan fitur "Tambah Stok"</p>
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('medicines.index') }}" class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition-colors hover:bg-slate-50">Batal</a>
                <button type="submit" class="flex-1 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/25 transition-all hover:from-emerald-600 hover:to-teal-600 active:scale-[0.98]">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection
