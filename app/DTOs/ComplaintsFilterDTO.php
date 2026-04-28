<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class ComplaintsFilterDTO
{
    public function __construct(
        public readonly ?int $idUser = null,
        public readonly ?string $status = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            idUser: $request->query('id_user'),
            status: $request->query('status'),
        );
    }
}
