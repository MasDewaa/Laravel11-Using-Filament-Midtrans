<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id', 
        'midtrans_order_id', 
        'status', 
        'payment_type', 
        'payment_url'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
