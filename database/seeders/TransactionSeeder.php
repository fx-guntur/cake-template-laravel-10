<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\Merchant\Merchant; // Pastikan menggunakan model Merchant

class TransactionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua merchant_id dari tabel merchants
        $merchantIds = Merchant::pluck('id')->toArray();

        if (empty($merchantIds)) {
            $this->command->info('No merchants found. Please seed the merchants table first.');
            return;
        }

        for ($i = 0; $i < 30; $i++) {
            DB::table('transactions')->insert([
                'uuid' => Str::uuid(),
                'merchant_id' => $faker->randomElement($merchantIds),
                'customer_id' => 1,
                'payment_id' => 1,
                'payment_code' => 'PMT' . $faker->unique()->numerify('#####'),
                'invoice' => 'INV' . $faker->unique()->numerify('#####'),
                'type' => $faker->randomElement(['Credit Card', 'Bank Transfer', 'E-Wallet']),
                'amount' => $faker->randomFloat(2, 100, 1000),
                'unique_code' => $faker->numberBetween(100, 999),
                'charge' => $faker->randomFloat(2, 1, 50),
                'transaction_date' => $faker->dateTimeBetween('-1 month', 'now'),
                'transaction_paid_date' => $faker->dateTimeBetween('-1 month', 'now'),
                'transaction_deadline' => $faker->dateTimeBetween('now', '+1 month'),
                'status' => $faker->randomElement(['pending', 'complete', 'cancel']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
