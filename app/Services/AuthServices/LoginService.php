<?php

namespace App\Services\AuthServices;

use Exception;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class LoginService
{
    #[ArrayShape(['token' => "string"])]
    public function handle(LoginRequest $request): array
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            throw new Exception('As credenciais fornecidas estão incorretas.', 422);
        }

        $user = Auth::user();

        return [
            'token' => $user->createToken($request->getClientIp())->plainTextToken
        ];
    }
}