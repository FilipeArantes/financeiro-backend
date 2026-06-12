<?php

namespace App\Repositories;

use App\DTOs\UserInputDTO;
use App\DTOs\UserUpdateDTO;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function list(): LengthAwarePaginator
    {
        return User::paginate(10);
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function update(int $id, UserUpdateDTO $dto): User
    {
        $user = User::findOrFail($id);
        $user->update($dto->toArray());

        return $user;
    }
}
