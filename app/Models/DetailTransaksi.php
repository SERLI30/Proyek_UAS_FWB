<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{

    protected $table = 'detail_transaksi';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'quantity',
        'subtotal',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}

