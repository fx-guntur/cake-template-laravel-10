<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('merchants')->insert([
            [
                'uuid' => Str::uuid(),
                'email' =>  'merchant@example.com',
                'username' => 'merchant',
                'password' => bcrypt('password123'), // Store hashed password
                'raw_password' => 'password123', // Store raw password if needed
                'created_at' => now()
            ],
            // Add more sample customers as needed
        ]);
    }
}
