<?php

use App\Hospital;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = ['A', 'B', 'C', 'D', 'E'];

        $faker = Faker::create('id_ID');
        for ($i = 0; $i <= 50; $i++) {
            $randTypes = array_rand($types);
            Hospital::insert([
                'name' => $faker->company(),
                'code' => rand(100000, 999999),
                'slug' => Str::slug($faker->company()),
                'phone' => $faker->phoneNumber,
                'mobile' => $faker->phoneNumber,
                'address' => $faker->address,
                'city' => $faker->city,
                'type' => $types[$randTypes],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);
        }
    }
}
