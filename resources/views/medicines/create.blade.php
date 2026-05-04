@extends('layouts.app')
@section('title', 'Tambah Obat')
@section('subtitle', 'Daftarkan obat baru')

@section('content')
<div class="mx-auto max-w-lg">
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/60">
        <form method="POST" action="{{ route('medicines.store') }}">
            @csrf
            <div class="space-y-5">
                <div>
                    <label for="nama_obat" class="mb-1.5 block text-sm font-medium text-slate-700">Nama Obat</label>
                    <input type="text" id="nama_obat" name="nama_obat" value="{{ old('nama_obat') }}" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10" placeholder="Contoh: Paracetamol">
                    @error('nama_obat') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="satuan" class="mb-1.5 block text-sm font-medium text-slate-700">Satuan</label>
                    <input type="text" id="satuan" name="satuan" value="{{ old('satuan') }}" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10" placeholder="Contoh: Tablet, Botol, Sachet">
                    @error('satuan') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="stok" class="mb-1.5 block text-sm font-medium text-slate-700">Stok Awal</label>
                    <input type="number" id="stok" name="stok" value="{{ old('stok', 0) }}" min="0" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
                    @error('stok') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('medicines.index') }}" class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition-colors hover:bg-slate-50">Batal</a>
                <button type="submit" class="flex-1 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/25 transition-all hover:from-emerald-600 hover:to-teal-600 active:scale-[0.98]">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
