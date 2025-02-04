<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Report;
use Carbon\Carbon;

class ChartController extends Controller
{
public function getChartData()
{
    // Contoh data laporan pemasukan dan pengeluaran
    $reports = Report::selectRaw('MONTH(created_at) as month, SUM(amount) as total, type')
        ->where('user_id', Auth::id())
        ->groupBy('month', 'type')
        ->orderBy('month')
        ->get();

    // Data bulanan untuk chart
    $labels = [];
    $incomeData = [];
    $expenseData = [];

    foreach (range(1, 12) as $month) {
        $labels[] = Carbon::create()->month($month)->translatedFormat('F'); // Nama bulan
        $incomeData[] = $reports->where('month', $month)->where('type', 'income')->sum('total');
        $expenseData[] = $reports->where('month', $month)->where('type', 'expense')->sum('total');
    }

    return response()->json([
        'labels' => $labels,
        'datasets' => [
            [
                'label' => 'Pemasukan',
                'data' => $incomeData,
                'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 1,
            ],
            [
                'label' => 'Pengeluaran',
                'data' => $expenseData,
                'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'borderWidth' => 1,
            ],
        ],
    ]);
}
}
