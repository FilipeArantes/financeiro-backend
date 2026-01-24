<?php

namespace App\Http\Controllers;

use App\DTOs\PaymentsInputDTO;
use App\Http\Requests\PaymentsFormRequest;
use App\Services\PaymentsService;

class PaymentsController extends Controller
{
    public function __construct(
        private PaymentsService $service,
    ) {}

    public function store(PaymentsFormRequest $request)
    {
        $payment = PaymentsInputDTO::fromRequest($request);
        $payment = $this->service->insert($payment);

        return response()->json(['data' => $payment->toArray()], 201);
    }
}
