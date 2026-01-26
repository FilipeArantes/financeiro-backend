<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class PaymentsFilterDTO
{
    public function __construct(
        public readonly ?int $idUser = null,
        public readonly ?string $dateFrom = null,
        public readonly ?string $dateTo = null,
        public readonly ?string $status = null,
        public readonly ?bool $boRectify = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            idUser: $request->query('id_user'),
            dateFrom: $request->query('date_from'),
            dateTo: $request->query('date_to'),
            status: $request->query('status'),
            boRectify: filter_var($request->query('bo_active'), FILTER_VALIDATE_BOOLEAN),
        );
    }
}
