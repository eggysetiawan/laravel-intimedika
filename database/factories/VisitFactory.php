<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Visit;
use Faker\Generator as Faker;

$factory->define(Visit::class, function (Faker $faker) {
    return [
        'customer_id' => rand(1, 50),
        'user_id' => rand(1, 6),
        'slug' => $faker->slug(),
        'result' => $faker->paragraph(10),
        'request' => $faker->sentence(),
        'is_visited' => '1',
    ];
});
