<?php

namespace App\Http\Controllers;

use App\Models\FinancialReport;
use Illuminate\Http\Request;
use App\Models\Transaction;

class FinancialReportController extends Controller
{
    public function index()
    {
        // Mengambil semua transaksi
        $transactions = Transaction::all();

        // Inisialisasi variabel untuk menyimpan data laporan keuangan
        $financialReports = [];

        // Iterasi melalui setiap transaksi dan proses datanya
        foreach ($transactions as $transaction) {
            // Proses data transaksi
            $tanggal = $transaction->created_at;
            $nama_transaksi = $transaction->subscription_model;
            $keterangan = $transaction->subscription_model . ' ' . $transaction->order_code;
            $debet = $transaction->subscription_model === 'Sales' ? $transaction->price * $transaction->qty : 0;
            $kredit = $transaction->subscription_model === 'Purchase' ? $transaction->price * $transaction->qty : 0;

            // Buat instansiasi FinancialReport dan set nilai propertinya
            $financialReport = new FinancialReport();
            $financialReport->tanggal = $tanggal;
            $financialReport->transaction_type = $nama_transaksi;
            $financialReport->description = $keterangan;
            $financialReport->debit = $debet;
            $financialReport->credit = $kredit;

            // Tambahkan objek FinancialReport ke dalam array
            $financialReports[] = $financialReport;
        }

        // Hitung total debet dan kredit dari laporan keuangan
        $total_debet = collect($financialReports)->sum('debit');
        $total_kredit = collect($financialReports)->sum('credit');

        // Kirim data ke view financial_reports.index
        return view('financial_reports.index', compact('financialReports', 'total_debet', 'total_kredit'));
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
