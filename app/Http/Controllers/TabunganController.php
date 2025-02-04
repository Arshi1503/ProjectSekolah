<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class TabunganController extends Controller
{
    public function index()
    {
        $totalIncome = Report::where('type', 'income')->sum('amount');
        $totalExpense = Report::where('type', 'expense')->sum('amount');
        $totalBalance= $totalIncome - $totalExpense;
        return view('tabungan.index', compact('totalBalance'));
    }
}
