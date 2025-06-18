<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Models\User;

class RouteServiceProvider extends ServiceProvider
{
    public static function redirectToByRole(User $user)
    {
        return match ($user->role) {
            'admin' => '/admin/dashboard',
            'penjual', 'seller' => '/penjual/produk',
            'pembeli' => '/pembeli/produk',
            default => '/home',
        };
    }

    public function boot()
    {
        parent::boot();
    }
}
