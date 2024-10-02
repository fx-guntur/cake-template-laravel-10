<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            [
                'uuid' => Str::uuid(),
                'username' => 'admin',
                'password' => bcrypt('password123'), // Store hashed password
                'raw_password' => 'password123', // Store raw password if needed
                'created_at' => now()
            ],
            // Add more entries if needed
        ]);
    }
}
