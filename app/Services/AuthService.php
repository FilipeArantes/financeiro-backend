<?php

namespace App\Services;

use App\DTOs\UserInputDTO;
use App\DTOs\UserOutputDTO;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(
        private UserRepository $userRepository,
    ) {}

    public function register(UserInputDTO $user): UserOutputDTO
    {
        $user = $this->userRepository->insert($user);
        $user->tokens()->delete();
        $token = $user->createToken('auth_token', [$user->role]);
        Auth::login($user);

        return new UserOutputDTO($user, $token->plainTextToken);
    }
}
