<?php

namespace App\Services;

use App\DTOs\UserOutputDTO;
use App\DTOs\UserUpdateDTO;
use App\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function __construct(
        private UserRepository $repository,
    ) {}

    public function list(): LengthAwarePaginator
    {
        return $this->repository->list();
    }

    public function detail(int $id): ?UserOutputDTO
    {
        $user = $this->repository->findById($id);

        return $user ? new UserOutputDTO($user) : null;
    }

    public function update(int $id, UserUpdateDTO $dto): UserOutputDTO
    {
        $user = $this->repository->update($id, $dto);

        return new UserOutputDTO($user);
    }
}
