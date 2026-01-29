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

    public function deactivate(int $id): int
    {
        return Payment::where('id', $id)
            ->update([
                'bo_active' => false,
                'status' => 'retificado',
            ]);
    }
}
