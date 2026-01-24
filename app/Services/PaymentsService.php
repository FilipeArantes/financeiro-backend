<?php

namespace App\Services;

use App\DTOs\PaymentsInputDTO;
use App\DTOs\PaymentsOutputDTO;
use App\Repositories\PaymentsRepository;

class PaymentsService
{
    public function __construct(
        private PaymentsRepository $repository,
    ) {}

    public function insert(PaymentsInputDTO $payment): PaymentsOutputDTO
    {
        $payment = $this->repository->insert($payment);

        return new PaymentsOutputDTO($payment);
    }
}
