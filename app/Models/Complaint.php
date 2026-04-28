<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_payment',
        'title',
        'description',
        'complain_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_payment');
    }
}
