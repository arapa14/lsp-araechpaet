<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make("admin123"),
                'phone' => '081283330679'
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@gmail.com',
                'role' => 'customer',
                'password' => Hash::make("customer123"),
                'phone' => '081283330679'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
