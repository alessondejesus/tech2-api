<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AuthServices\MeService;

class MeController extends Controller
{
    public function __construct(private readonly MeService $service)
    {
    }

    public function __invoke(Request $request): array
    {
        return $this->service->handle($request);
    }
}
