<?php

namespace Database\Seeders;

use App\Models\Incident;
use App\Models\IncidentType;
use App\Models\User;
use Illuminate\Database\Seeder;

class IncidentSeeder extends Seeder
{
    public function run(): void
    {
        $incidents = [
            [
                'description' => 'Small fire reported in the storage room on level 2.',
                'status' => 'in_progress',
                'incident_type' => 'Fire',
                'reporter_email' => 'alice@example.com',
            ],
            [
                'description' => 'Security personnel noticed forced entry signs at the rear door.',
                'status' => 'reported',
                'incident_type' => 'Security Breach',
                'reporter_email' => 'bob@example.com',
            ],
            [
                'description' => 'Employee experienced dizziness and required medical attention.',
                'status' => 'resolved',
                'incident_type' => 'Medical Emergency',
                'reporter_email' => 'carol@example.com',
            ],
        ];

        foreach ($incidents as $data) {
            $type = IncidentType::where('name', $data['incident_type'])->first();
            $reporter = User::where('email', $data['reporter_email'])->first();

            if (! $type || ! $reporter) {
                continue;
            }

            Incident::updateOrCreate(
                ['description' => $data['description']],
                [
                    'status' => $data['status'],
                    'incident_type_id' => $type->id,
                    'reported_by' => $reporter->id,
                ]
            );
        }
    }
}
