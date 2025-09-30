<?php

namespace App\Policies;

use App\Models\Incident;
use App\Models\User;

class IncidentPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Incident $incident)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Incident $incident)
    {
        return $user->id === $incident->reported_by || $user->role === 'admin';
    }

    public function delete(User $user, Incident $incident)
    {
        return $user->id === $incident->reported_by || $user->role === 'admin';
    }
}
