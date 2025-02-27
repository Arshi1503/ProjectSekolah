<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Menampilkan daftar laporan
        public function index()
    {
        $reports = Report::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $incomes = Report::where('user_id', Auth::id())
            ->where('type', 'income')
            ->sum('amount');

        $expenses = Report::where('user_id', Auth::id())
            ->where('type', 'expense')
            ->sum('amount');


        return view('report.index', compact('reports', 'incomes', 'expenses'));
    }

    
    

    // Menampilkan form untuk menambahkan laporan baru
    public function create()
    {
        return view('reports.create');
    }

    // Menyimpan laporan baru
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
        ]);

        Report::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'amount' => $request->amount,
        ]);

        session()->flash('success', 'Laporan berhasil disimpan!');

        return redirect()->route('report.index');
    }

    // Menampilkan detail laporan
    public function show(Report $report)
    {
        // Pastikan laporan milik pengguna yang sedang login
        abort_if($report->user_id !==  Auth::id(), 403);

        return view('report.show', compact('report'));
    }

    // Menampilkan form untuk mengedit laporan
    public function edit(Report $report)
    {
        abort_if($report->user_id !==  Auth::id(), 403);

        return view('report.edit', compact('report'));
    }

    // Memperbarui laporan
    public function update(Request $request, Report $report)
    {
        abort_if($report->user_id !==  Auth::id(), 403);

        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $report->update($request->only(['type', 'amount', 'description']));

        return redirect()->route('report.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    // Menghapus laporan
    public function destroy(Report $report)
    {
        abort_if($report->user_id !==  Auth::id(), 403);

        $report->delete();

        return redirect()->route('report.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
