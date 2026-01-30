<?php

namespace App\Services;

use App\DTOs\PaymentsFilterDTO;
use App\DTOs\PaymentsInputDTO;
use App\DTOs\PaymentsOutputDTO;
use App\Models\Payment;
use App\Repositories\PaymentsRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentsService
{
    public function __construct(
        private PaymentsRepository $repository,
    ) {}

    public function listByUser(int $userId, PaymentsFilterDTO $paymentsFilter): LengthAwarePaginator
    {
        $query = Payment::query()
            ->where('id_user', $userId)
            ->where('bo_active', true);

        if ($paymentsFilter->dateFrom) {
            $query->where('payment_date', '>=', $paymentsFilter->dateFrom);
        }

        if ($paymentsFilter->dateTo) {
            $query->where('payment_date', '<=', $paymentsFilter->dateTo);
        }

        return $query->paginate(10);
    }

    public function list(PaymentsFilterDTO $paymentsFilter): LengthAwarePaginator
    {
        $query = Payment::query();

        if ($paymentsFilter->boRectify) {
            $query->where('bo_active', $paymentsFilter->boRectify);
        }

        if ($paymentsFilter->idUser) {
            $query->where('id_user', $paymentsFilter->idUser);
        }

        if ($paymentsFilter->status) {
            $query->where('status', $paymentsFilter->status);
        }

        if ($paymentsFilter->dateFrom) {
            $query->where('payment_date', '>=', $paymentsFilter->dateFrom);
        }

        if ($paymentsFilter->dateTo) {
            $query->where('payment_date', '<=', $paymentsFilter->dateTo);
        }

        return $query->paginate(10);
    }

    public function insert(PaymentsInputDTO $payment): PaymentsOutputDTO
    {
        $payment = $this->repository->insert($payment);

        return $payment ? new PaymentsOutputDTO($payment) : null;
    }

    public function rectify(PaymentsInputDTO $newPayment, int $idOldPayment): PaymentsOutputDTO
    {
        $this->repository->deactivate($idOldPayment);
        $payment = $this->repository->insert($newPayment);

        return new PaymentsOutputDTO($payment);
    }

    public function detail(int $userId, int $paymentId): ?PaymentsOutputDTO
    {
        $payment = Payment::where('id', $paymentId)
            ->where('id_user', $userId)
            ->first();

        return $payment ? new PaymentsOutputDTO($payment) : null;
    }
}
