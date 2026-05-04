@extends('layouts.app')
@section('title', isset($readonly) ? 'Stok Obat' : 'Data Obat')
@section('subtitle', isset($readonly) ? 'Lihat stok obat tersedia' : 'Kelola data obat')

@section('content')
<div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/60">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h3 class="text-base font-semibold text-slate-800">{{ isset($readonly) ? 'Stok Obat' : 'Daftar Obat' }}</h3>
        @if(!isset($readonly))
        <a href="{{ route('medicines.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/25 transition-all hover:shadow-xl hover:from-emerald-600 hover:to-teal-600 active:scale-[0.98]">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
            Tambah Obat
        </a>
        @endif
    </div>

    {{-- Search --}}
    <form method="GET" class="mb-6 flex gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama obat..."
            class="flex-1 rounded-xl border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
        <button type="submit" class="rounded-xl bg-slate-800 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-slate-700">Cari</button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-200">
                    <th class="py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">No</th>
                    <th class="py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">Nama Obat</th>
                    <th class="py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">Satuan</th>
                    <th class="py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">Stok</th>
                    @if(!isset($readonly))
                    <th class="py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-400">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($medicines as $index => $medicine)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-3.5 text-slate-500">{{ $medicines->firstItem() + $index }}</td>
                    <td class="py-3.5 font-medium text-slate-700">{{ $medicine->nama_obat }}</td>
                    <td class="py-3.5 text-slate-500">{{ $medicine->satuan }}</td>
                    <td class="py-3.5">
                        @if($medicine->stok <= 0)
                            <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-1 text-xs font-bold text-red-700 ring-1 ring-red-200">Habis</span>
                        @elseif($medicine->stok < 10)
                            <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700 ring-1 ring-amber-200">{{ $medicine->stok }}</span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200">{{ $medicine->stok }}</span>
                        @endif
                    </td>
                    @if(!isset($readonly))
                    <td class="py-3.5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('medicines.add-stock', $medicine) }}" class="rounded-lg p-2 text-slate-400 transition-colors hover:bg-emerald-50 hover:text-emerald-600" title="Tambah Stok">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                            </a>
                            <a href="{{ route('medicines.edit', $medicine) }}" class="rounded-lg p-2 text-slate-400 transition-colors hover:bg-amber-50 hover:text-amber-600" title="Edit">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path></svg>
                            </a>
                            <form id="delete-form-medicine-{{ $medicine->id }}" action="{{ route('medicines.destroy', $medicine) }}" method="POST" class="hidden">
                                @csrf @method('DELETE')
                            </form>
                            <button type="button" onclick="deleteConfirm('delete-form-medicine-{{ $medicine->id }}', 'Yakin ingin menghapus obat ini?')" class="rounded-lg p-2 text-slate-400 transition-colors hover:bg-red-50 hover:text-red-600" title="Hapus">
                                <svg class="h-4 w-4 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path></svg>
                            </button>
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr><td colspan="{{ isset($readonly) ? 4 : 5 }}" class="py-12 text-center text-slate-400">Belum ada data obat</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $medicines->links() }}</div>
</div>
@endsection
