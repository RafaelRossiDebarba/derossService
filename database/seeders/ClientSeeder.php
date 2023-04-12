<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class CLientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('pt_BR');
        
        foreach (range(1, 10) as $index) {
            DB::table('clients')->insert([
                'name' => $faker->name,
                'address' => $faker->streetName,
                'city' => $faker->city,
                'number' => $faker->buildingNumber,
                'fone' => $faker->cellphoneNumber
            ]);
        }
    }
}
