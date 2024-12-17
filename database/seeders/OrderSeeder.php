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
        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('orders')->insert([
                'client_id'  => $faker->numberBetween(1, 100),
                'status'     => $faker->numberBetween(1, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            for ($j = 1; $j <= rand(1, 3); $j++) {
                DB::table('order_lines')->insert([
                    'name'       => $faker->word(),
                    'quantity'   => $faker->numberBetween(1, 10),
                    'price'      => $faker->numberBetween(100, 10000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('order_order_lines_pivot')->insert([
                    'order_id'      => $i,
                    'order_line_id' => $j,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
