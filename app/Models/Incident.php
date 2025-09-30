<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'status',
        'incident_type_id',
        'reported_by',
    ];

    protected $casts = [
        'reported_at' => 'datetime',
    ];

    public function incidentType()
    {
        return $this->belongsTo(IncidentType::class);
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }
}
