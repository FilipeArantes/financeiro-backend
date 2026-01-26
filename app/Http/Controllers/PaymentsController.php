<?php

namespace App\Http\Controllers;

use App\DTOs\PaymentsFilterDTO;
use App\DTOs\PaymentsInputDTO;
use App\Http\Requests\PaymentsFormRequest;
use App\Services\PaymentsService;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function __construct(
        private PaymentsService $service,
    ) {}

    public function index(Request $request)
    {
        $paymentsFilter = PaymentsFilterDTO::fromRequest($request);
        $payments = $this->service->listByUser($request->user()->id, $paymentsFilter);

        return response()->json(['data' => $payments], 200);
    }

    public function indexAdmin(Request $request)
    {
        $paymentsFilter = PaymentsFilterDTO::fromRequest($request);
        $payments = $this->service->list($paymentsFilter);

        return response()->json(['data' => $payments], 200);
    }

    public function store(PaymentsFormRequest $request)
    {
        $payment = PaymentsInputDTO::fromRequest($request);
        $payment = $this->service->insert($payment);

        return response()->json(['data' => $payment->toArray()], 201);
    }

    public function rectify(int $payment, PaymentsFormRequest $request)
    {
        $newPayment = PaymentsInputDTO::fromRequest($request);
        $payment = $this->service->rectify($newPayment, $payment);

        return response()->json(['data' => $payment->toArray()], 201);
    }
}
