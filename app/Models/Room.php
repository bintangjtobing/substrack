<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id','email','password', 'max_users', 'available_users'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'room_customer_transaction')
            ->withPivot('transaction_id')
            ->withTimestamps();
    }
}
