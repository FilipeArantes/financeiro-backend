<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class ComplaintsInputDTO
{
    public function __construct(
        public readonly int $idUser,
        public readonly int $idPayment,
        public readonly string $title,
        public readonly string $description,
        public readonly string $complainDate,
        public readonly string $status = 'aberta',
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            idUser: $request->user()->id,
            idPayment: $request->id_payment,
            title: $request->title,
            description: $request->description,
            complainDate: now()->toDateTimeString(),
        );
    }

    public function toArray(): array
    {
        return [
            'id_user' => $this->idUser,
            'id_payment' => $this->idPayment,
            'title' => $this->title,
            'description' => $this->description,
            'complain_date' => $this->complainDate,
            'status' => $this->status,
        ];
    }
}
