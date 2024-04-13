<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_date', 'customer_id', 'product_id', 'subscription_model', 'price', 'qty'];

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
        return $this->hasOne(Room::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
