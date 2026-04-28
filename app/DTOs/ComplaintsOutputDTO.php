<?php

namespace App\DTOs;

use App\Models\Complaint;

class ComplaintsOutputDTO
{
    public readonly int $id;
    public readonly int $idUser;
    public readonly int $idPayment;
    public readonly string $title;
    public readonly string $description;
    public readonly string $complainDate;
    public readonly string $status;

    public function __construct(Complaint $complaint)
    {
        $this->id = $complaint->id;
        $this->idUser = $complaint->id_user;
        $this->idPayment = $complaint->id_payment;
        $this->title = $complaint->title;
        $this->description = $complaint->description;
        $this->complainDate = $complaint->complain_date;
        $this->status = $complaint->status;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'id_user' => $this->idUser,
            'id_payment' => $this->idPayment,
            'title' => $this->title,
            'description' => $this->description,
            'complain_date' => $this->complainDate,
            'status' => $this->status,
        ];
    }
}
