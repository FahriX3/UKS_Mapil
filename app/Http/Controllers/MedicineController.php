<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Medicine::query();

        if ($request->filled('search')) {
            $query->where('nama_obat', 'like', '%' . $request->search . '%');
        }

        $medicines = $query->orderBy('nama_obat')->paginate(15)->withQueryString();

        return view('medicines.index', compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medicines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
        ]);

        Medicine::create($request->only(['nama_obat', 'satuan', 'stok']));

        return redirect()->route('medicines.index')
            ->with('success', 'Obat berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
        ]);

        $medicine->update($request->only(['nama_obat', 'satuan']));

        return redirect()->route('medicines.index')
            ->with('success', 'Data obat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return redirect()->route('medicines.index')
            ->with('success', 'Obat berhasil dihapus.');
    }

    /**
     * Show add stock form.
     */
    public function showAddStock(Medicine $medicine)
    {
        return view('medicines.add-stock', compact('medicine'));
    }

    /**
     * Add stock to a medicine.
     */
    public function addStock(Request $request, Medicine $medicine)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $medicine->increment('stok', $request->jumlah);

        return redirect()->route('medicines.index')
            ->with('success', "Stok {$medicine->nama_obat} berhasil ditambah {$request->jumlah} {$medicine->satuan}.");
    }
}
