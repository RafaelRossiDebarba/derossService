<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{   
    /**
     * Run the database seeds.
     * php artisan db:seed --class=ProductSeeder
     */
    public function run(): void
    {
        $faker = Faker::create('pt_BR');
        
        foreach (range(1, 10) as $index) {
            DB::table('products')->insert([
                'name' => sprintf("product %d", $index),
                'qtd' => $faker->optional($weight = 100)->randomDigit,
                'price' => $faker->optional($weight = 100)->randomDigit,
            ]);
        }
    }
}
