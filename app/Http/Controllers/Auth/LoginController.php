<?php

namespace App\Http\Controllers\Auth;

use Exception;
use JetBrains\PhpStorm\ArrayShape;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthServices\LoginService;

class LoginController extends Controller
{
    public function __construct(private readonly LoginService $service)
    {
    }

    /**
     * Handle an authentication attempt.
     * @throws Exception
     */
    #[ArrayShape(['token' => "string"])]
    public function __invoke(LoginRequest $request): array
    {
        return $this->service->handle($request);
    }
}
