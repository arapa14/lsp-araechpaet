<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirlineSeeder extends Seeder
{
    public function run(): void
    {
        $airlines = [
            ['name' => 'Lion Air', 'code' => 'LA', 'logo' => 'logos/lionair.png', 'country' => 'Indonesia'],
            ['name' => 'Garuda Indonesia', 'code' => 'GA', 'logo' => 'logos/garuda.png', 'country' => 'Indonesia'],
            ['name' => 'AirAsia', 'code' => 'AA', 'logo' => 'logos/airasia.png', 'country' => 'Indonesia'],
        ];

        foreach ($airlines as $airline) {
            Airline::updateOrCreate(
                ['code' => $airline['code']], // unique key
                $airline
            );
        }
    }
}
