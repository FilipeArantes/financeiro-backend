<?php

namespace App\Http\Controllers;

use App\DTOs\UserInputDTO;
use App\Http\Requests\RegisterFormRequest;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(
        private AuthService $service,
    ) {}

    public function store(RegisterFormRequest $request)
    {
        $user = UserInputDTO::fromRequest($request);
        $user = $this->service->register($user);

        return response()->json(['data' => $user->toArray()], 201);
    }
}
