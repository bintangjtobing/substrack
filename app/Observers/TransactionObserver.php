<?php

namespace App\Observers;

use App\Models\FinancialReport;
use App\Models\Transaction;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction)
    {
        // Calculate total revenue, total cost, and net income
        $totalRevenue = $transaction->price * $transaction->qty;
        $totalCost = $transaction->product->cost * $transaction->qty; // Menggunakan kolom cost
        $netIncome = $totalRevenue - $totalCost;

        // Create financial report entry
        FinancialReport::create([
            'transaction_id' => $transaction->id,
            'total_revenue' => $totalRevenue,
            'total_cost' => $totalCost,
            'net_income' => $netIncome,
        ]);
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
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
