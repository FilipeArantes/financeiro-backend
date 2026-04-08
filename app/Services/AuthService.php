<?php

namespace App\Services;

use App\DTOs\LoginInputDTO;
use App\DTOs\UserInputDTO;
use App\DTOs\UserOutputDTO;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function login(LoginInputDTO $credentials): ?UserOutputDTO
    {
        $user = $this->userRepository->findByEmail($credentials->email);

        if (!$user || !Hash::check($credentials->password, $user->password)) {
            return null;
        }

        $user->tokens()->delete();
        $token = $user->createToken('auth_token', [$user->role]);

        return new UserOutputDTO($user, $token->plainTextToken);
    }
}
