<?php

namespace App\Http\Controllers;

use App\Models\FinancialReport;
use Illuminate\Http\Request;

class FinancialReportController extends Controller
{
    public function index()
    {
        $financialReports = FinancialReport::all();
        return view('financial_reports.index', compact('financialReports'));
    }

    public function create()
    {
        // Tambahkan logika jika diperlukan
    }

    public function store(Request $request)
    {
        // Tambahkan logika untuk menyimpan financial report jika diperlukan
    }

    public function show(FinancialReport $financialReport)
    {
        return view('financial_reports.show', compact('financialReport'));
    }

    public function edit(FinancialReport $financialReport)
    {
        // Tambahkan logika jika diperlukan
    }

    public function update(Request $request, FinancialReport $financialReport)
    {
        // Tambahkan logika untuk memperbarui financial report jika diperlukan
    }

    public function destroy(FinancialReport $financialReport)
    {
        // Tambahkan logika untuk menghapus financial report jika diperlukan
    }
}
