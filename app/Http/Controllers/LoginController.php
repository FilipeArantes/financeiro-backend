<?php

namespace App\Http\Controllers;

use App\DTOs\LoginInputDTO;
use App\Http\Requests\LoginFormRequest;
use App\Services\AuthService;

class LoginController extends Controller
{
    public function __construct(
        private AuthService $service,
    ) {}

    public function store(LoginFormRequest $request)
    {
        $credentials = LoginInputDTO::fromRequest($request);
        $user = $this->service->login($credentials);

        if (!$user) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        return response()->json(['data' => $user->toArray()], 200);
    }
}