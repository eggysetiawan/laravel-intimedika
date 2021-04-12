<?php

use App\Customer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i <= 50; $i++) {
            $customer = Customer::insert([
                'user_id' => rand(1, 6),
                'slug' => $faker->slug(),
                'name' => $faker->name,
                'mobile' => $faker->phoneNumber,
                'role' => $faker->jobTitle,
                'city' => $faker->city,
                'address' => $faker->address,
                'email' => $faker->safeEmail,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);

            // $customer->hospitals()->attach(rand(1, 50));
        }
    }
}
