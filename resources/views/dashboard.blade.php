@extends('layouts.app')
@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan data UKS hari ini')

@section('content')
{{-- Stat Cards --}}
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-6">
    <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200/60 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/5">
        <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-gradient-to-br from-emerald-100 to-teal-100 opacity-50 transition-transform duration-500 group-hover:scale-125"></div>
        <div class="relative">
            <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 shadow-lg shadow-emerald-500/20">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"></path></svg>
            </div>
            <p class="text-2xl font-bold text-slate-800">{{ $totalSiswa }}</p>
            <p class="text-xs font-medium text-slate-400">Total Siswa</p>
        </div>
    </div>

    <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200/60 transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/5">
        <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 opacity-50 transition-transform duration-500 group-hover:scale-125"></div>
        <div class="relative">
            <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-400 to-purple-500 shadow-lg shadow-indigo-500/20">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"></path></svg>
            </div>
            <p class="text-2xl font-bold text-slate-800">{{ $totalObat }}</p>
            <p class="text-xs font-medium text-slate-400">Jenis Obat</p>
        </div>
    </div>

    <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200/60 transition-all duration-300 hover:shadow-lg hover:shadow-amber-500/5">
        <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-gradient-to-br from-amber-100 to-orange-100 opacity-50 transition-transform duration-500 group-hover:scale-125"></div>
        <div class="relative">
            <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 shadow-lg shadow-amber-500/20">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75"></path></svg>
            </div>
            <p class="text-2xl font-bold text-slate-800">{{ $totalKunjunganBulanIni }}</p>
            <p class="text-xs font-medium text-slate-400">Kunjungan Bulan Ini</p>
        </div>
    </div>

    <div class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200/60 transition-all duration-300 hover:shadow-lg hover:shadow-red-500/5">
        <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-gradient-to-br from-red-100 to-pink-100 opacity-50 transition-transform duration-500 group-hover:scale-125"></div>
        <div class="relative">
            <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-red-400 to-pink-500 shadow-lg shadow-red-500/20">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path></svg>
            </div>
            <p class="text-2xl font-bold text-slate-800">{{ $obatStokRendah->count() }}</p>
            <p class="text-xs font-medium text-slate-400">Obat Stok Rendah</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    {{-- Chart --}}
    <div class="lg:col-span-2 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/60">
        <h3 class="mb-4 text-sm font-semibold text-slate-800">Grafik Kunjungan {{ now()->year }}</h3>
        <canvas id="visitChart" height="120"></canvas>
    </div>

    {{-- Low Stock Alert --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/60">
        <h3 class="mb-4 text-sm font-semibold text-slate-800">⚠️ Stok Obat Rendah</h3>
        @if($obatStokRendah->isEmpty())
            <div class="flex flex-col items-center justify-center py-8 text-center">
                <div class="text-3xl mb-2">✅</div>
                <p class="text-sm text-slate-400">Semua stok obat aman</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($obatStokRendah as $obat)
                <div class="flex items-center justify-between rounded-xl bg-red-50 px-4 py-3 ring-1 ring-red-100">
                    <div>
                        <p class="text-sm font-medium text-slate-700">{{ $obat->nama_obat }}</p>
                        <p class="text-xs text-slate-400">{{ $obat->satuan }}</p>
                    </div>
                    <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-bold text-red-600">{{ $obat->stok }}</span>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- Recent Visits --}}
<div class="mt-6 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/60">
    <div class="mb-4 flex items-center justify-between">
        <h3 class="text-sm font-semibold text-slate-800">Kunjungan Terakhir</h3>
        <a href="{{ route('treatments.index') }}" class="text-xs font-medium text-emerald-600 hover:text-emerald-700 transition-colors">Lihat Semua →</a>
    </div>
    @if($kunjunganTerakhir->isEmpty())
        <p class="text-center py-8 text-sm text-slate-400">Belum ada kunjungan</p>
    @else
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-100">
                    <th class="pb-3 text-left text-xs font-semibold text-slate-400">Tanggal</th>
                    <th class="pb-3 text-left text-xs font-semibold text-slate-400">Siswa</th>
                    <th class="pb-3 text-left text-xs font-semibold text-slate-400">Kelas</th>
                    <th class="pb-3 text-left text-xs font-semibold text-slate-400">Keluhan</th>
                    <th class="pb-3 text-left text-xs font-semibold text-slate-400">Petugas</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($kunjunganTerakhir as $visit)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-3 text-slate-600">{{ $visit->tanggal_kunjungan->format('d/m/Y') }}</td>
                    <td class="py-3 font-medium text-slate-700">{{ $visit->student->nama }}</td>
                    <td class="py-3 text-slate-500">{{ $visit->student->kelas->nama }}</td>
                    <td class="py-3 text-slate-500">{{ Str::limit($visit->keluhan, 30) }}</td>
                    <td class="py-3 text-slate-500">{{ $visit->user->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@push('scripts')
<script>
    const ctx = document.getElementById('visitChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: {!! json_encode(array_values($chartData)) !!},
                backgroundColor: 'rgba(16, 185, 129, 0.2)',
                borderColor: 'rgb(16, 185, 129)',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f1f5f9' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endpush
@endsection
