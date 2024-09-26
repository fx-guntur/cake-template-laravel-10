<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    // Get valid merchant ids from the merchants table
    $merchantIds = DB::table('merchants')->pluck('id')->toArray();

    // Loop through each merchant and create a product for each
    foreach ($merchantIds as $merchantId) {
        DB::table('product')->insert([
            'uuid' => Str::uuid(),
            'merchant_id' => $merchantId, // Use each merchant id
            'name' => 'Product for Merchant ' . $merchantId,
            'price' => rand(100, 10000),
            'description' => 'This is a description for product for merchant ' . $merchantId,
            'is_active' => rand(0, 1),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ]);
    }
}

}
