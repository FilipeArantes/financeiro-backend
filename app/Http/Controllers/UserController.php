<?php

namespace App\Http\Controllers;

use App\DTOs\UserUpdateDTO;
use App\Http\Requests\UserUpdateFormRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        private UserService $service,
    ) {}

    public function index()
    {
        $users = $this->service->list();

        return response()->json(['data' => $users], 200);
    }

    public function show(int $user)
    {
        $result = $this->service->detail($user);

        if (!$result) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }

        return response()->json(['data' => $result->toArray()], 200);
    }

    public function update(int $user, UserUpdateFormRequest $request)
    {
        $dto = UserUpdateDTO::fromRequest($request);
        $result = $this->service->update($user, $dto);

        return response()->json(['data' => $result->toArray()], 200);
    }
}
