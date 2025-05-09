<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AuthServices\LogoutService;

class LogoutController extends Controller
{
    public function __construct(private readonly LogoutService $service)
    {
    }

    public function __invoke(Request $request): void
    {
        $this->service->handle($request);
    }
}
