<?php

namespace App\Http\Controllers;

use App\DTOs\ComplaintsFilterDTO;
use App\DTOs\ComplaintsInputDTO;
use App\Http\Requests\ComplaintsFormRequest;
use App\Services\ComplaintsService;
use Illuminate\Http\Request;

class ComplaintsController extends Controller
{
    public function __construct(
        private ComplaintsService $service,
    ) {}

    public function index(Request $request)
    {
        $filter = ComplaintsFilterDTO::fromRequest($request);
        $complaints = $this->service->listByUser($request->user()->id, $filter);

        return response()->json(['data' => $complaints], 200);
    }

    public function indexAdmin(Request $request)
    {
        $filter = ComplaintsFilterDTO::fromRequest($request);
        $complaints = $this->service->list($filter);

        return response()->json(['data' => $complaints], 200);
    }

    public function store(ComplaintsFormRequest $request)
    {
        $complaint = ComplaintsInputDTO::fromRequest($request);
        $complaint = $this->service->insert($complaint);

        if (!$complaint) {
            return response()->json(['message' => 'Pagamento não pertence ao usuário autenticado'], 403);
        }

        return response()->json(['data' => $complaint], 201);
    }

    public function show(Request $request, int $complaint)
    {
        $complaint = $this->service->detail($request->user()->id, $complaint);

        if (!$complaint) {
            return response()->json(['message' => 'Reclamação não encontrada'], 404);
        }

        return response()->json(['data' => $complaint], 200);
    }

    public function resolve(int $complaint)
    {
        $this->service->resolve($complaint);

        return response()->json(['message' => 'Reclamação resolvida com sucesso'], 200);
    }
}
