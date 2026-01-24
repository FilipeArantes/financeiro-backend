<?php

namespace App\Repositories;

use App\DTOs\PaymentsInputDTO;
use App\Models\Payment;

class PaymentsRepository
{
    public function insert(PaymentsInputDTO $payment): Payment
    {
        return Payment::create($payment->toArray());
    }
}
