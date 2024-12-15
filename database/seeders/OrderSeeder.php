<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            DB::table('orders')->insert([
                'client_id' => Factory::create()->numberBetween(1, 100),
                'status' => Factory::create()->numberBetween(1, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            for ($j = 1; $j <= rand(1, 3); $j++) {
                DB::table('order_lines')->insert([
                    'order_id' => $i,
                    'name' => Factory::create()->word(),
                    'quantity' => Factory::create()->numberBetween(1, 10),
                    'price' => Factory::create()->numberBetween(100, 10000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
