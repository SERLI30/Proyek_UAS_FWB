<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        return redirect()->intended(
            RouteServiceProvider::redirectToByRole($request->user())
        );
    }
}
