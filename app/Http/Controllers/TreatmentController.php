<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Student;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Treatment::with(['student.kelas', 'user', 'medicines']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_kunjungan', $request->tanggal);
        }

        $treatments = $query->orderBy('tanggal_kunjungan', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('treatments.index', compact('treatments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::with('kelas')->orderBy('nama')->get();
        $medicines = Medicine::where('stok', '>', 0)->orderBy('nama_obat')->get();

        return view('treatments.create', compact('students', 'medicines'));
    }

    /**
     * Store a newly created resource in storage using DB Transaction.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'tanggal_kunjungan' => 'required|date',
            'medicines' => 'nullable|array',
            'medicines.*.id' => 'required_with:medicines|exists:medicines,id',
            'medicines.*.jumlah' => 'required_with:medicines|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Create treatment
                $treatment = Treatment::create([
                    'student_id' => $request->student_id,
                    'user_id' => auth()->id(),
                    'keluhan' => $request->keluhan,
                    'diagnosa' => $request->diagnosa,
                    'tanggal_kunjungan' => $request->tanggal_kunjungan,
                ]);

                // Attach medicines and reduce stock
                if ($request->has('medicines')) {
                    foreach ($request->medicines as $med) {
                        if (empty($med['id']) || empty($med['jumlah'])) {
                            continue;
                        }

                        $medicine = Medicine::lockForUpdate()->findOrFail($med['id']);

                        if ($medicine->stok < $med['jumlah']) {
                            throw new \Exception("Stok {$medicine->nama_obat} tidak mencukupi. Sisa stok: {$medicine->stok} {$medicine->satuan}.");
                        }

                        // Attach to pivot table
                        $treatment->medicines()->attach($med['id'], [
                            'jumlah' => $med['jumlah'],
                        ]);

                        // Reduce stock
                        $medicine->decrement('stok', $med['jumlah']);
                    }
                }
            });

            return redirect()->route('treatments.index')
                ->with('success', 'Catatan kunjungan berhasil disimpan.');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Treatment $treatment)
    {
        $treatment->load(['student.kelas', 'user', 'medicines']);
        return view('treatments.show', compact('treatment'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatment $treatment)
    {
        DB::transaction(function () use ($treatment) {
            // Restore stock for each medicine
            foreach ($treatment->medicines as $medicine) {
                $medicine->increment('stok', $medicine->pivot->jumlah);
            }

            $treatment->delete();
        });

        return redirect()->route('treatments.index')
            ->with('success', 'Catatan kunjungan berhasil dihapus dan stok obat dikembalikan.');
    }
}
