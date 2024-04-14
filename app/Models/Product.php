<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'sales_type', 'subscription_model', 'price', 'qty', 'supplier_id','cost'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function getShortDescriptionAttribute()
    {
        return strlen($this->description) > 30 ? substr($this->description, 0, 30) . '...' : $this->description;
    }
}
