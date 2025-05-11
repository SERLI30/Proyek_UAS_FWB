<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{

    protected $table = 'kategori';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = ['name'];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}

