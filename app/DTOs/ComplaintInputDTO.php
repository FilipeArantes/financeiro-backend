<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class ComplaintInputDTO
{
    public function __construct(
        public readonly int $idPayment,
        public readonly string $complaintDate,
        public readonly ?string $description,
        public readonly string $status = 'aberta',
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            idPayment: $request->id_user,
            complaintDate: $request->payment_date,
            description: $request->description,
            status: $request->input('status', 'aberta'),
        );
    }

    public function toArray(): array
    {
        return [
            'id_user' => $this->idPayment,
            'complaint_date' => $this->complaintDate,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
