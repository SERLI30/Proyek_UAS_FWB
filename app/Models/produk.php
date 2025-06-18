<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'name',
        'price',
        'stok',
        'deskripsi',
        'kategori_id',
        'seller_id',
        'gambar', 
    ];

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Relasi ke Penjual (User)
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // Relasi ke DetailTransaksi (produk bisa muncul di banyak transaksi)
    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'produk_id');
    }

    // Relasi ke Transaksi lewat tabel pivot 'detail_transaksi'
    public function transaksi()
    {
        return $this->belongsToMany(Transaksi::class, 'detail_transaksi')
                    ->withPivot('quantity', 'subtotal')
                    ->withTimestamps();
    }
}
