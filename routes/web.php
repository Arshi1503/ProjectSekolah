<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

# Nama Route Route diatur
Route::middleware(['auth'])->group(function () {
    Route::resource('reports', ReportController::class);
});


Route::middleware('auth', 'verified')->group(function () {
    Route::view('/', 'welcome')->name('home');
    Route::view('/tabungan', 'tabungan')->name('tabungan');
    Route::view('/report', 'report')->name('report'); 
    Route::get('/dashboard', function () {
        return view('dashboard');})->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
