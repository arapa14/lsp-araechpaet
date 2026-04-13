<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $payments = [
            [
                'name' => 'Bank BCA',
                'logo' => 'payments/bca.png',
                'no' => '1234567890'
            ],
            [
                'name' => 'Bank BNI',
                'logo' => 'payments/bni.png',
                'no' => '0987654321'
            ],
            [
                'name' => 'Bank Mandiri',
                'logo' => 'payments/mandiri.png',
                'no' => '1122334455'
            ],
            [
                'name' => 'BRI',
                'logo' => 'payments/bri.png',
                'no' => '5566778899'
            ],
            [
                'name' => 'QRIS',
                'logo' => 'payments/qris.png',
                'no' => null
            ],
        ];

        foreach ($payments as $payment) {
            Payment::updateOrCreate(
                ['name' => $payment['name']], // unique identifier
                $payment
            );
        }
    }
}
