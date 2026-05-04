@extends('layouts.app')
@section('title', 'Laporan Kunjungan')
@section('subtitle', 'Rekapitulasi data kunjungan UKS')

@section('content')
{{-- Year Filter --}}
<div class="mb-6 flex items-center gap-4">
    <form method="GET" class="flex items-center gap-3">
        <label class="text-sm font-medium text-slate-600">Tahun:</label>
        <select name="tahun" onchange="this.form.submit()" class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium transition-all focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
            @foreach($availableYears as $y)
                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>
    </form>
    <div class="ml-auto rounded-xl bg-gradient-to-r from-emerald-50 to-teal-50 px-4 py-2.5 ring-1 ring-emerald-200/50">
        <p class="text-sm font-semibold text-emerald-700">Total Kunjungan {{ $year }}: <span class="text-lg">{{ $totalKunjunganTahun }}</span></p>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    {{-- Chart --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/60">
        <h3 class="mb-4 text-sm font-semibold text-slate-800">Grafik Kunjungan per Bulan</h3>
        <canvas id="reportChart" height="200"></canvas>
    </div>

    {{-- Table --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/60">
        <h3 class="mb-4 text-sm font-semibold text-slate-800">Tabel Rekapitulasi</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">Bulan</th>
                        <th class="py-3 text-center text-xs font-semibold uppercase tracking-wider text-slate-400">Kunjungan</th>
                        <th class="py-3 text-center text-xs font-semibold uppercase tracking-wider text-slate-400">Siswa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($reportData as $data)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-3 font-medium text-slate-700">{{ $data['bulan'] }}</td>
                        <td class="py-3 text-center">
                            @if($data['total_kunjungan'] > 0)
                                <span class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700">{{ $data['total_kunjungan'] }}</span>
                            @else
                                <span class="text-xs text-slate-300">0</span>
                            @endif
                        </td>
                        <td class="py-3 text-center">
                            @if($data['total_siswa'] > 0)
                                <span class="inline-flex items-center rounded-full bg-indigo-100 px-2.5 py-1 text-xs font-bold text-indigo-700">{{ $data['total_siswa'] }}</span>
                            @else
                                <span class="text-xs text-slate-300">0</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t-2 border-slate-200 bg-slate-50">
                        <td class="py-3 font-bold text-slate-800">Total</td>
                        <td class="py-3 text-center font-bold text-emerald-700">{{ $totalKunjunganTahun }}</td>
                        <td class="py-3 text-center font-bold text-indigo-700">-</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const ctx = document.getElementById('reportChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(16, 185, 129, 0.3)');
    gradient.addColorStop(1, 'rgba(16, 185, 129, 0.02)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: {!! json_encode($chartValues) !!},
                fill: true,
                backgroundColor: gradient,
                borderColor: 'rgb(16, 185, 129)',
                borderWidth: 2.5,
                tension: 0.4,
                pointBackgroundColor: 'rgb(16, 185, 129)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f1f5f9' } },
                x: { grid: { display: false }, ticks: { font: { size: 11 } } }
            }
        }
    });
</script>
@endpush
@endsection
