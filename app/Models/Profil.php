<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{

    protected $table = 'profil';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'users_id',
        'alamat',
        'no_hp',
       
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}


