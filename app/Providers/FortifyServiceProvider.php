<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Http\Responses\LoginResponse as CustomLoginResponse;
use App\Http\Responses\RegisterResponse as CustomRegisterResponse;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;

class FortifyServiceProvider extends ServiceProvider
{
   
public function register(): void
{
    $this->app->singleton(LoginResponse::class, CustomLoginResponse::class);
    $this->app->singleton(RegisterResponse::class, CustomRegisterResponse::class);
}


    public function boot(): void
{
   
}
}