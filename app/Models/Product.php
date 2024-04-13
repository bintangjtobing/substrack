<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'sales_type', 'subscription_model', 'price', 'qty', 'supplier_id'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
