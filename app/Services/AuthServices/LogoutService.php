<?php

namespace App\Services\AuthServices;

use Illuminate\Http\Request;

class LogoutService
{
    public function handle(Request $request): void
    {
        $request->user()->tokens()->delete();
    }
}