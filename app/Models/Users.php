<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Profil;


class Users extends Model
{
    protected $table = 'users';
 // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [ 'name','email','password',  'role',   
    ];
        

    public function produk()
    {
        return $this->hasMany(Produk::class, 'seller_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'customer_id');
    }

    public function profil()
    {
        return $this->hasOne(Profil::class, 'users_id');
    }
}


