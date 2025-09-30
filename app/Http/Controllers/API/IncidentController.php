<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Incident\StoreIncidentRequest;
use App\Http\Requests\Incident\UpdateIncidentRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Incident;
use App\Services\IncidentService;
use Illuminate\Support\Facades\Auth;

class IncidentController extends Controller
{
    public function __construct(private readonly IncidentService $service)
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index()
    {
        $incidents = $this->service->list();
        return ApiResponse::success($incidents);
    }

    public function store(StoreIncidentRequest $request)
    {
        $data = $request->validated();
        $data['reported_by'] = Auth::id();
        $data['status'] = $data['status'] ?? 'reported';

        $incident = $this->service->create($data);
        return ApiResponse::created($incident);
    }

    public function show(Incident $incident)
    {
        $incident->load(['incidentType', 'reporter']);
        return ApiResponse::success($incident);
    }

    public function update(UpdateIncidentRequest $request, Incident $incident)
    {
        $this->authorize('update', $incident);

        $updated = $this->service->update($incident, $request->validated());
        return ApiResponse::success($updated);
    }

    public function destroy(Incident $incident)
    {
        $this->authorize('delete', $incident);
        $this->service->delete($incident);
        return ApiResponse::success(null, 'Deleted', 204);
    }
}
