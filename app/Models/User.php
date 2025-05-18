<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi tambahan
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
