<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data
        DB::table('customers')->insert([
            [
                'uuid' => Str::uuid(),
                'name' => 'John Doe',
                'phone' => '1234567890',
                'email' => 'john@example.com',
                'username' => 'johnny',
                'password' => bcrypt('password123'), // Store hashed password
                'raw_password' => 'password123', // Store raw password if needed
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Jane Smith',
                'phone' => '0987654321',
                'email' => 'jane@example.com',
                'username' => 'janesmith',
                'password' => bcrypt('password456'), // Store hashed password
                'raw_password' => 'password456', // Store raw password if needed
            ],
            // Add more sample customers as needed
        ]);
    }
}
