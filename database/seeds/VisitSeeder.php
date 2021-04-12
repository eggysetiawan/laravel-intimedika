<?php


use App\Visit;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VisitSeeder extends Seeder
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

            Visit::insert([
                'customer_id' => rand(1, 50),
                'user_id' => rand(1, 6),
                'slug' => $faker->slug(),
                'result' => $faker->paragraph(10),
                'request' => $faker->sentence(),
                'is_visited' => '1',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);
        }
    }
}
