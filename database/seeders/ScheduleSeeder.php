<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Plane;
use App\Models\City;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $planes = Plane::all();
        $cities = City::all();

        if ($planes->isEmpty() || $cities->count() < 2) {
            $this->command->warn('Seeder membutuhkan minimal 1 plane dan 2 city.');
            return;
        }

        foreach ($planes as $plane) {

            // tiap pesawat punya beberapa jadwal
            for ($i = 0; $i < 5; $i++) {

                // pilih origin & destination (tidak boleh sama)
                $origin = $cities->random();
                do {
                    $destination = $cities->random();
                } while ($destination->id === $origin->id);

                // generate waktu keberangkatan (1 - 30 hari ke depan)
                $departure = Carbon::now()
                    ->addDays(rand(1, 30))
                    ->setHour(rand(0, 23))
                    ->setMinute([0, 15, 30, 45][rand(0, 3)])
                    ->setSecond(0);

                // durasi flight (1 - 5 jam)
                $durationHours = rand(1, 5);

                $arrival = (clone $departure)->addHours($durationHours);

                Schedule::firstOrCreate([
                    'plane_id' => $plane->id,
                    'origin_id' => $origin->id,
                    'destination_id' => $destination->id,
                    'departure_time' => $departure,
                ], [
                    'arrival_time' => $arrival,
                    'price' => rand(500000, 2000000),
                    'available_seats' => $plane->seats()->count()
                ]);
            }
        }
    }
}
