<?php

namespace App\DTOs;

use App\Models\Payment;

class PaymentsOutputDTO
{
    public readonly int $id;
    public readonly int $idUser;
    public readonly float $value;
    public readonly string $paymentDate;
    public readonly ?string $description;
    public readonly string $status;

    public function __construct(Payment $payment)
    {
        $this->id = $payment->id;
        $this->idUser = $payment->id_user;
        $this->value = $payment->value;
        $this->paymentDate = $payment->payment_date;
        $this->description = $payment->description;
        $this->status = $payment->status;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'id_user' => $this->idUser,
            'value' => $this->value,
            'payment_date' => $this->paymentDate,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
