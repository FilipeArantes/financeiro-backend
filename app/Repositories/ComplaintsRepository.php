<?php

namespace App\Repositories;

use App\DTOs\ComplaintsInputDTO;
use App\Models\Complaint;

class ComplaintsRepository
{
    public function insert(ComplaintsInputDTO $complaint): Complaint
    {
        return Complaint::create($complaint->toArray());
    }

    public function resolve(int $id): int
    {
        return Complaint::where('id', $id)
            ->update(['status' => 'resolvida']);
    }
}
