<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class LoginInputDTO
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            email: $request->email,
            password: $request->password,
        );
    }
}