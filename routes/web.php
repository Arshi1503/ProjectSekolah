<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

# Nama Route Route diatur
Route::middleware(['auth'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('report.index');
    Route::post('/reports', [ReportController::class, 'store'])->name('report.store');
});


Route::middleware('auth', 'verified')->group(function () {
    Route::view('/', 'welcome')->name('home');
    Route::view('/tabungan', 'tabungan')->name('tabungan');
    Route::get('/dashboard', function () {
        return view('dashboard');})->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
