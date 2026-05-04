<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Medicine;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show dashboard with statistics.
     */
    public function index()
    {
        $totalSiswa = Student::count();
        $totalObat = Medicine::count();
        $totalKunjunganBulanIni = Treatment::whereMonth('tanggal_kunjungan', now()->month)
            ->whereYear('tanggal_kunjungan', now()->year)
            ->count();
        $obatStokRendah = Medicine::where('stok', '<', 10)->get();

        // Kunjungan 7 hari terakhir
        $kunjunganTerakhir = Treatment::with(['student.kelas', 'user'])
            ->orderBy('tanggal_kunjungan', 'desc')
            ->limit(5)
            ->get();

        // Grafik kunjungan per bulan (tahun ini)
        $kunjunganPerBulan = Treatment::select(
                DB::raw('MONTH(tanggal_kunjungan) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('tanggal_kunjungan', now()->year)
            ->groupBy(DB::raw('MONTH(tanggal_kunjungan)'))
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        // Fill missing months with 0
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[$i] = $kunjunganPerBulan[$i] ?? 0;
        }

        return view('dashboard', compact(
            'totalSiswa',
            'totalObat',
            'totalKunjunganBulanIni',
            'obatStokRendah',
            'kunjunganTerakhir',
            'chartData'
        ));
    }
}
