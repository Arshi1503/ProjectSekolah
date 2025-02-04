<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TabunganController;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Route;


// Meng-check apakah user sudah login
Route::get('/', function() {
   if(FacadesAuth::check()) {
       return redirect()->route('dashboard');
   } else{
       return view('auth.register');
   }
});

//Route untuk dashboard
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
// Route Untuk Chart
Route::middleware(['auth'])->get('/chart-data', [ChartController::class, 'getChartData'])->name('chart-data'); #CHART

// Nama Route Report
Route::middleware(['auth'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('report.index');
    Route::post('/reports', [ReportController::class, 'store'])->name('report.store');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('report.create');
    Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('report.destroy');
});
// Nama Route Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Nama Route Data
Route::middleware('auth')->group(function () {
    Route::get('/tabungan', [TabunganController::class, 'index'])->name('tabungan');
});


require __DIR__.'/auth.php';
