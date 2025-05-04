<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class detail_transaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    protected $fillable = ['transaksi_id', 'produk_id', 'quantity', 'subtotal'];
}
