<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $recentReports = Report::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $totalIncome = Report::where('type', 'income')->sum('amount');
        $totalExpense = Report::where('type', 'expense')->sum('amount');
        $totalBalance= $totalIncome - $totalExpense;
        return view('dashboard', compact('totalIncome', 'totalExpense', 'totalBalance', 'recentReports'));
    }
}
