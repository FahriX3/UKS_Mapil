<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root to dashboard
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard - accessible by all authenticated users
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Only Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas'])->except(['show']);
        Route::resource('students', StudentController::class)->except(['show']);
        Route::resource('medicines', MedicineController::class)->except(['show']);
        Route::get('/medicines/{medicine}/add-stock', [MedicineController::class, 'showAddStock'])->name('medicines.add-stock');
        Route::post('/medicines/{medicine}/add-stock', [MedicineController::class, 'addStock'])->name('medicines.add-stock.store');
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });

    // Admin & Petugas Routes
    Route::middleware(['role:admin, petugas'])->group(function () {
        
        Route::resource('treatments', TreatmentController::class)->except(['edit', 'update']);
        Route::get('/stok-obat', function () {
            $medicines = \App\Models\Medicine::orderBy('nama_obat')->paginate(15);
            return view('medicines.index', compact('medicines'))->with('readonly', true);
        })->name('stok-obat');
    });
});
