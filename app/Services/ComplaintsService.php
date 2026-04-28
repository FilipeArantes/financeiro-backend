<?php

namespace App\Services;

use App\DTOs\ComplaintsFilterDTO;
use App\DTOs\ComplaintsInputDTO;
use App\DTOs\ComplaintsOutputDTO;
use App\Models\Complaint;
use App\Models\Payment;
use App\Repositories\ComplaintsRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ComplaintsService
{
    public function __construct(
        private ComplaintsRepository $repository,
    ) {}

    public function listByUser(int $userId, ComplaintsFilterDTO $filter): LengthAwarePaginator
    {
        $query = Complaint::query()->where('id_user', $userId);

        if ($filter->status) {
            $query->where('status', $filter->status);
        }

        return $query->paginate(10);
    }

    public function list(ComplaintsFilterDTO $filter): LengthAwarePaginator
    {
        $query = Complaint::query();

        if ($filter->idUser) {
            $query->where('id_user', $filter->idUser);
        }

        if ($filter->status) {
            $query->where('status', $filter->status);
        }

        return $query->paginate(10);
    }

    public function insert(ComplaintsInputDTO $complaint): ?ComplaintsOutputDTO
    {
        $paymentBelongsToUser = Payment::where('id', $complaint->idPayment)
            ->where('id_user', $complaint->idUser)
            ->exists();

        if (!$paymentBelongsToUser) {
            return null;
        }

        $created = $this->repository->insert($complaint);

        return new ComplaintsOutputDTO($created);
    }

    public function resolve(int $complaintId): void
    {
        $complaint = Complaint::where('id', $complaintId)->firstOrFail();

        if ($complaint->status === 'resolvida') {
            abort(422, 'Reclamação já foi resolvida');
        }

        $this->repository->resolve($complaintId);
    }

    public function detail(int $userId, int $complaintId): ?ComplaintsOutputDTO
    {
        $complaint = Complaint::where('id', $complaintId)
            ->where('id_user', $userId)
            ->first();

        return $complaint ? new ComplaintsOutputDTO($complaint) : null;
    }
}
