<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            ['name' => 'Jakarta', 'code' => 'CGK'],
            ['name' => 'Surabaya', 'code' => 'SUB'],
            ['name' => 'Bandung', 'code' => 'BDO'],
            ['name' => 'Denpasar', 'code' => 'DPS'],
            ['name' => 'Yogyakarta', 'code' => 'YIA'],
            ['name' => 'Medan', 'code' => 'KNO'],
            ['name' => 'Makassar', 'code' => 'UPG'],
            ['name' => 'Balikpapan', 'code' => 'BPN'],
            ['name' => 'Palembang', 'code' => 'PLM'],
            ['name' => 'Semarang', 'code' => 'SRG'],
        ];

        foreach ($cities as $city) {
            City::updateOrCreate(
                ['code' => $city['code']], // unique identifier
                $city
            );
        }
    }
}
