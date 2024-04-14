<?php

namespace App\Observers;

use App\Models\FinancialReport;
use App\Models\Transaction;
use App\Models\Room;
use Str;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction)
    {
        // Cek apakah sudah ada entri laporan keuangan untuk saldo awal
        $initialBalanceReport = FinancialReport::where('description', 'Initial Balance')->get();

        // Jika tidak ada entri laporan keuangan untuk saldo awal, tambahkan entri baru
        if ($initialBalanceReport->isEmpty()) {
            FinancialReport::create([
                'transaction_id' => 1,
                'transaction_date' => now()->toDateString(),
                'description' => 'Initial Balance',
                'total_revenue' => 0,
                'total_cost' => 0,
                'balance' => 0,
            ]);
        }
        $initialLastBalanceReport = FinancialReport::orderBy('id', 'desc')->first();
        // dd($initialLastBalanceReport);

        // Menghitung total revenue dan total cost
        $totalRevenue = $transaction->subscription_model === 'Sales' ? $transaction->price * $transaction->qty : 0;
        $totalCost = $transaction->subscription_model === 'Purchase' ? $transaction->price * $transaction->qty : 0;

        // Menghitung net income berdasarkan subscription model
        if ($transaction->subscription_model === 'Purchase') {
            $netIncome = -$totalCost;
        } else {
            $netIncome = $totalRevenue;
        }

        // Mendapatkan balance terakhir atau 0 jika tidak ada
        if ($initialLastBalanceReport) {
            $lastBalance = $initialLastBalanceReport->balance;
        }

        // Menghitung balance terbaru
        $newBalance = $lastBalance + $netIncome;

        // Buat entri transaksi
        FinancialReport::create([
            'transaction_id' => $transaction->id,
            'transaction_date' => $transaction->transaction_date,
            'description' => $transaction->subscription_model.' '.$transaction->order_code,
            'total_revenue' => $totalRevenue,
            'total_cost' => $totalCost,
            'balance' => $newBalance, // Saldo terbaru setelah transaksi
        ]);

        // Untuk ke room
        if ($transaction->subscription_model === 'Purchase' && $transaction->supplier_id) {
            // Generate email untuk kamar dengan format 'roompty-gr{id}@boxity'
            $email = 'roompty-gr00' . $transaction->id . '@boxity.id';

            // Generate password acak
            $password = 'BCIPTY'.Str::random(8); // Ubah 8 sesuai dengan panjang yang diinginkan

            // Inisialisasi max_users dan available_users
            $maxUsers = 11;
            $availableUsers = $maxUsers;

            // Buat entri baru dalam model Room
            Room::create([
                'transaction_id' => $transaction->id,
                'email' => $email,
                'password' => $password,
                'max_users' => $maxUsers,
                'available_users' => $availableUsers,
            ]);
        }
    }








    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        $totalRevenue = $transaction->price * $transaction->qty;
        $totalCost = $transaction->product->cost * $transaction->qty; // Menggunakan kolom cost
        $netIncome = $totalRevenue - $totalCost;

        // Find existing financial report entry for the transaction
        $financialReport = FinancialReport::where('transaction_id', $transaction->id)->first();

        if ($financialReport) {
            // Update existing financial report entry
            $financialReport->update([
                'total_revenue' => $totalRevenue,
                'total_cost' => $totalCost,
                'net_income' => $netIncome,
            ]);
        } else {
            // Create new financial report entry
            FinancialReport::create([
                'transaction_id' => $transaction->id,
                'total_revenue' => $totalRevenue,
                'total_cost' => $totalCost,
                'net_income' => $netIncome,
            ]);
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        $financialReport = FinancialReport::where('transaction_id', $transaction->id)->first();

        if ($financialReport) {
            $financialReport->delete();
        }
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
