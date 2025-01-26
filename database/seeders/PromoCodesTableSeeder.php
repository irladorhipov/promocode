<?php

namespace Database\Seeders;

use App\Models\PromoCode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PromoCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promoCodes = [
            [
                'code' => Str::upper(Str::random(10)),
                'amount' => 100,
                'is_active' => true,
                'expires_at' => now()->addDays(30),
            ],
            [
                'code' => 'WELCOME2023',
                'amount' => 200,
                'is_active' => true,
                'expires_at' => now()->addDays(60),
            ],
            [
                'code' => 'SUMMER50',
                'amount' => 50,
                'is_active' => true,
                'expires_at' => now()->addDays(15),
            ],
            [
                'code' => 'FREESHIP',
                'amount' => 0,
                'is_active' => true,
                'expires_at' => now()->addDays(7),
            ],
            [
                'code' => 'DISCOUNT20',
                'amount' => 20,
                'is_active' => false,
                'expires_at' => now()->addDays(10),
            ],
        ];

        foreach ($promoCodes as $promoCode) {
            PromoCode::create($promoCode);
        }

        $this->command->info('Тестовые промокоды успешно добавлены!');
    }
}
