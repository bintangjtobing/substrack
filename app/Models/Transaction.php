<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_date', 'customer_id', 'supplier_id', 'product_id', 'subscription_model', 'price', 'qty', 'order_code'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            // Generate order code
            $orderCode = 'ORD/' . date('m/Y') . '/' . static::generateOrderNumber();
            $transaction->order_code = $orderCode;
        });
    }

    protected static function generateOrderNumber()
    {
        // Get the current month and year
        $month = date('m');
        $year = date('Y');

        // Get the count of transactions for the current month
        $count = static::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        // Increment count and format as three digits
        $count++;

        return str_pad($count, 3, '0', STR_PAD_LEFT);
    }
}
