<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = ['name', 'price', 'stock', 'description', 'kategori_id', 'seller_id'];
}
