<?php

namespace App\DTOs;

use App\Models\User;

class UserOutputDTO
{
    public readonly int $id;
    public readonly string $name;
    public readonly string $email;
    public readonly string $role;
    public string $token = '';

    public function __construct(User $user, string $token = '')
    {
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->token = $token;
    }

    public function toArray(): array
    {
        $data = [
            'id'    => $this->id,
            'name'  => $this->name,
            'email' => $this->email,
            'role'  => $this->role,
        ];

        if ($this->token !== '') {
            $data['token'] = $this->token;
        }

        return $data;
    }
}
