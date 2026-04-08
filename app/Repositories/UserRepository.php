<?php

namespace App\Repositories;

use App\DTOs\UserInputDTO;
use App\Models\User;

class UserRepository
{
    public function insert(UserInputDTO $user): User
    {
        return User::create($user->toArray());
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
