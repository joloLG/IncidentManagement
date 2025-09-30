<?php

namespace App\Services;

use App\Models\Incident;

class IncidentService
{
    public function list(): \Illuminate\Database\Eloquent\Collection
    {
        return Incident::with(['incidentType', 'reporter'])->get();
    }

    public function create(array $data): Incident
    {
        $incident = Incident::create($data);
        $incident->load(['incidentType', 'reporter']);
        return $incident;
    }

    public function update(Incident $incident, array $data): Incident
    {
        $incident->update($data);
        $incident->load(['incidentType', 'reporter']);
        return $incident;
    }

    public function delete(Incident $incident): void
    {
        $incident->delete();
    }
}
