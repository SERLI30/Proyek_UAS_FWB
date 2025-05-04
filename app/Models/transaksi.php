<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = ['customer_id', 'total_price', 'status', 'payment_method'];
}
