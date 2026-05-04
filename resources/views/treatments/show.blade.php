@extends('layouts.app')
@section('title', 'Detail Kunjungan')
@section('subtitle', 'Informasi lengkap kunjungan')

@section('content')
<div class="mx-auto max-w-2xl">
    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-slate-200/60 overflow-hidden">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold">{{ $treatment->student->nama }}</h3>
                    <p class="mt-1 text-sm text-emerald-100">{{ $treatment->student->nis }} · {{ $treatment->student->kelas->nama }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-emerald-100">Tanggal Kunjungan</p>
                    <p class="text-lg font-bold">{{ $treatment->tanggal_kunjungan->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <h4 class="mb-2 text-xs font-semibold uppercase tracking-wider text-slate-400">Keluhan</h4>
                    <p class="text-sm text-slate-700 leading-relaxed">{{ $treatment->keluhan }}</p>
                </div>
                <div>
                    <h4 class="mb-2 text-xs font-semibold uppercase tracking-wider text-slate-400">Diagnosa Awal</h4>
                    <p class="text-sm text-slate-700 leading-relaxed">{{ $treatment->diagnosa }}</p>
                </div>
            </div>

            {{-- Medicines --}}
            <div>
                <h4 class="mb-3 text-xs font-semibold uppercase tracking-wider text-slate-400">Obat yang Diberikan</h4>
                @if($treatment->medicines->isEmpty())
                    <p class="text-sm text-slate-400">Tidak ada obat yang diberikan</p>
                @else
                <div class="overflow-x-auto rounded-xl ring-1 ring-slate-200">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="py-2.5 px-4 text-left text-xs font-semibold text-slate-500">Nama Obat</th>
                                <th class="py-2.5 px-4 text-left text-xs font-semibold text-slate-500">Jumlah</th>
                                <th class="py-2.5 px-4 text-left text-xs font-semibold text-slate-500">Satuan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($treatment->medicines as $med)
                            <tr>
                                <td class="py-2.5 px-4 font-medium text-slate-700">{{ $med->nama_obat }}</td>
                                <td class="py-2.5 px-4 text-slate-600">{{ $med->pivot->jumlah }}</td>
                                <td class="py-2.5 px-4 text-slate-500">{{ $med->satuan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            {{-- Footer Info --}}
            <div class="rounded-xl bg-slate-50 p-4 text-xs text-slate-500">
                <p>Dicatat oleh: <span class="font-semibold text-slate-700">{{ $treatment->user->name }}</span> ({{ $treatment->user->role }})</p>
                <p class="mt-1">Waktu: {{ $treatment->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <a href="{{ route('treatments.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition-colors hover:bg-slate-50">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path></svg>
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
