<?php

namespace App\Services\AuthServices;

use App\Models\User;
use Illuminate\Http\Request;

class MeService
{
    public function handle(Request $request): array
    {
        /** @var User $user */
        $user = $request->user();

        return $user->only('id', 'name', 'email');
    }
}