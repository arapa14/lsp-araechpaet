<?php

namespace Database\Seeders;

use App\Models\Plane;
use App\Models\Seat;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    public function run(): void
    {
        $rows = range('A', 'F'); // A-F
        $numbers = range(1, 10); // 1-10

        $planes = Plane::all();

        foreach ($planes as $plane) {
            $seats = [];

            foreach ($rows as $row) {
                foreach ($numbers as $number) {
                    $seats[] = [
                        'plane_id' => $plane->id,
                        'seat_number' => $row . $number,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            Seat::insert($seats);
        }
    }
}