<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class PaymentsInputDTO
{
    public function __construct(
        public readonly int $idUser,
        public readonly float $value,
        public readonly string $paymentDate,
        public readonly ?string $description,
        public readonly string $status = 'pago',
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            idUser: $request->id_user,
            value: $request->value,
            paymentDate: $request->payment_date,
            description: $request->description,
            status: $request->input('status', 'pago'),
        );
    }

    public function toArray(): array
    {
        return [
            'id_user' => $this->idUser,
            'value' => $this->value,
            'payment_date' => $this->paymentDate,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
