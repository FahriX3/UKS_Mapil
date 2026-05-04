@extends('layouts.app')
@section('title', 'Catatan Kunjungan')
@section('subtitle', 'Riwayat kunjungan UKS')

@section('content')
<div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/60">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h3 class="text-base font-semibold text-slate-800">Daftar Kunjungan</h3>
        <a href="{{ route('treatments.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/25 transition-all hover:shadow-xl hover:from-emerald-600 hover:to-teal-600 active:scale-[0.98]">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
            Catat Kunjungan
        </a>
    </div>

    {{-- Filters --}}
    <form method="GET" class="mb-6 flex flex-col gap-3 sm:flex-row">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama siswa atau NIS..."
            class="flex-1 rounded-xl border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
        <input type="date" name="tanggal" value="{{ request('tanggal') }}"
            class="rounded-xl border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
        <button type="submit" class="rounded-xl bg-slate-800 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-slate-700">Filter</button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-200">
                    <th class="py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">Tanggal</th>
                    <th class="py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">Siswa</th>
                    <th class="py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">Kelas</th>
                    <th class="py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">Keluhan</th>
                    <th class="py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">Obat</th>
                    <th class="py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">Petugas</th>
                    <th class="py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($treatments as $t)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-3.5 text-slate-600">{{ $t->tanggal_kunjungan->format('d/m/Y') }}</td>
                    <td class="py-3.5 font-medium text-slate-700">{{ $t->student->nama }}</td>
                    <td class="py-3.5"><span class="rounded-full bg-indigo-50 px-2 py-0.5 text-xs font-medium text-indigo-600">{{ $t->student->kelas->nama }}</span></td>
                    <td class="py-3.5 text-slate-500">{{ Str::limit($t->keluhan, 25) }}</td>
                    <td class="py-3.5">
                        <div class="flex flex-wrap gap-1">
                            @foreach($t->medicines->take(2) as $med)
                                <span class="rounded-full bg-emerald-50 px-2 py-0.5 text-[11px] font-medium text-emerald-600">{{ $med->nama_obat }}</span>
                            @endforeach
                            @if($t->medicines->count() > 2)
                                <span class="rounded-full bg-slate-100 px-2 py-0.5 text-[11px] font-medium text-slate-500">+{{ $t->medicines->count() - 2 }}</span>
                            @endif
                            @if($t->medicines->isEmpty())
                                <span class="text-xs text-slate-400">-</span>
                            @endif
                        </div>
                    </td>
                    <td class="py-3.5 text-slate-500 text-xs">{{ $t->user->name }}</td>
                    <td class="py-3.5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('treatments.show', $t) }}" class="rounded-lg p-2 text-slate-400 transition-colors hover:bg-indigo-50 hover:text-indigo-600" title="Detail">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path></svg>
                            </a>
                            @if(auth()->user()->isAdmin())
                            <form id="delete-form-treatment-{{ $t->id }}" action="{{ route('treatments.destroy', $t) }}" method="POST" class="hidden">
                                @csrf @method('DELETE')
                            </form>
                            <button type="button" onclick="deleteConfirm('delete-form-treatment-{{ $t->id }}', 'Hapus kunjungan ini? Stok obat akan dikembalikan.')" class="rounded-lg p-2 text-slate-400 transition-colors hover:bg-red-50 hover:text-red-600" title="Hapus">
                                <svg class="h-4 w-4 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path></svg>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="py-12 text-center text-slate-400">Belum ada catatan kunjungan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $treatments->links() }}</div>
</div>
@endsection
