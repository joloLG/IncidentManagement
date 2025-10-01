<?php

namespace Database\Seeders;

use App\Models\IncidentType;
use Illuminate\Database\Seeder;

class IncidentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Fire',
                'description' => 'Incidents involving fire breakouts or smoke sightings.',
            ],
            [
                'name' => 'Medical Emergency',
                'description' => 'Injuries, illnesses, or medical-related incidents requiring assistance.',
            ],
            [
                'name' => 'Natural Disaster',
                'description' => 'Floods, earthquakes, typhoons, and other weather-related incidents.',
            ],
            [
                'name' => 'Security Breach',
                'description' => 'Unauthorized access, theft, or other security-related incidents.',
            ],
        ];

        foreach ($types as $type) {
            IncidentType::updateOrCreate(
                ['name' => $type['name']],
                $type
            );
        }
    }
}
