<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{

    protected $table = 'transaksi';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'customer_id',
        'total_price',
        'status',
        'payment_method',
        'lokasi_temu',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'detail_transaksi')
                    ->withPivot('quantity', 'subtotal')
                    ->withTimestamps();
    }
}


