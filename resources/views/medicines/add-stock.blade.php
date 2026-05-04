@extends('layouts.app')
@section('title', 'Tambah Stok Obat')
@section('subtitle', 'Tambah stok masuk')

@section('content')
<div class="mx-auto max-w-lg">
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/60">
        <div class="mb-6 rounded-xl bg-gradient-to-br from-indigo-50 to-purple-50 p-4 ring-1 ring-indigo-100">
            <h4 class="font-semibold text-slate-800">{{ $medicine->nama_obat }}</h4>
            <p class="mt-1 text-sm text-slate-500">Stok saat ini: <span class="font-bold text-indigo-600">{{ $medicine->stok }} {{ $medicine->satuan }}</span></p>
        </div>

        <form method="POST" action="{{ route('medicines.add-stock.store', $medicine) }}">
            @csrf
            <div class="mb-5">
                <label for="jumlah" class="mb-1.5 block text-sm font-medium text-slate-700">Jumlah Stok Masuk</label>
                <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" min="1" required class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10" placeholder="Masukkan jumlah">
                @error('jumlah') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3">
                <a href="{{ route('medicines.index') }}" class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition-colors hover:bg-slate-50">Batal</a>
                <button type="submit" class="flex-1 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/25 transition-all hover:from-emerald-600 hover:to-teal-600 active:scale-[0.98]">Tambah Stok</button>
            </div>
        </form>
    </div>
</div>
@endsection
