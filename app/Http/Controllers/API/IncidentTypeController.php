<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncidentType\StoreIncidentTypeRequest;
use App\Http\Requests\IncidentType\UpdateIncidentTypeRequest;
use App\Http\Responses\ApiResponse;
use App\Models\IncidentType;

class IncidentTypeController extends Controller
{
    public function index()
    {
        $incidentTypes = IncidentType::all();
        return ApiResponse::success($incidentTypes);
    }

    public function store(StoreIncidentTypeRequest $request)
    {
        $incidentType = IncidentType::create($request->validated());
        return ApiResponse::created($incidentType);
    }

    public function show(IncidentType $incidentType)
    {
        return ApiResponse::success($incidentType);
    }

    public function update(UpdateIncidentTypeRequest $request, IncidentType $incidentType)
    {
        $incidentType->update($request->validated());
        return ApiResponse::success($incidentType);
    }

    public function destroy(IncidentType $incidentType)
    {
        if ($incidentType->incidents()->exists()) {
            return ApiResponse::error('Cannot delete incident type with associated incidents', 422);
        }

        $incidentType->delete();
        return ApiResponse::success(null, 'Deleted', 204);
    }
}
