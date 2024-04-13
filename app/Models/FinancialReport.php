<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialReport extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id', 'total_revenue', 'total_cost', 'net_income'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
