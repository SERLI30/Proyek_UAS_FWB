<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{

    protected $table = 'produk';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
        'kategori_id',
        'seller_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function transaksi()
    {
        return $this->belongsToMany(Transaksi::class, 'detail_transaksi')
                    ->withPivot('quantity', 'subtotal')
                    ->withTimestamps();
    }
}


