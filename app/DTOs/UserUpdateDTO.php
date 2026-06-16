<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class UserUpdateDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $role,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->name,
            email: $request->email,
            role: $request->role,
        );
    }

    public function toArray(): array
    {
        return [
            'name'  => $this->name,
            'email' => $this->email,
            'role'  => $this->role,
        ];
    }
}
