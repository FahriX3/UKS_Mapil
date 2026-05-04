<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display visit report with table and chart.
     */
    public function index(Request $request)
    {
        $year = $request->get('tahun', now()->year);
        $availableYears = Treatment::selectRaw('YEAR(tanggal_kunjungan) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        if (empty($availableYears)) {
            $availableYears = [now()->year];
        }

        // Monthly visit count
        $monthlyData = Treatment::select(
                DB::raw('MONTH(tanggal_kunjungan) as bulan'),
                DB::raw('COUNT(*) as total_kunjungan'),
                DB::raw('COUNT(DISTINCT student_id) as total_siswa')
            )
            ->whereYear('tanggal_kunjungan', $year)
            ->groupBy(DB::raw('MONTH(tanggal_kunjungan)'))
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        // Build complete 12 months data
        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        $reportData = [];
        $chartLabels = [];
        $chartValues = [];

        foreach ($namaBulan as $num => $nama) {
            $data = $monthlyData->get($num);
            $reportData[] = [
                'bulan' => $nama,
                'total_kunjungan' => $data ? $data->total_kunjungan : 0,
                'total_siswa' => $data ? $data->total_siswa : 0,
            ];
            $chartLabels[] = $nama;
            $chartValues[] = $data ? $data->total_kunjungan : 0;
        }

        $totalKunjunganTahun = array_sum($chartValues);

        return view('reports.index', compact(
            'reportData',
            'chartLabels',
            'chartValues',
            'year',
            'availableYears',
            'totalKunjunganTahun'
        ));
    }
}
