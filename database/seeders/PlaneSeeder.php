<?php

namespace Database\Seeders;

use App\Models\Airline;
use App\Models\Plane;
use Illuminate\Database\Seeder;

class PlaneSeeder extends Seeder
{
    public function run(): void
    {
        $planes = [
            'Lion Air' => ['Airbus A320', 'Airbus A321'],
            'Garuda Indonesia' => ['Boeing 737-800', 'Boeing 737-900'],
            'AirAsia' => ['Airbus A320', 'Airbus A321'],
        ];

        foreach ($planes as $airlineName => $planeList) {
            $airline = Airline::where('name', $airlineName)->first();

            foreach ($planeList as $planeName) {
                Plane::updateOrCreate(
                    [
                        'airline_id' => $airline->id,
                        'name' => $planeName
                    ],
                    []
                );
            }
        }
    }
}
