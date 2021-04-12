<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Visit;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Visit::class, function (Faker $faker) {
    return [
        'customer_id' => $faker->unique()->randomDigit,
        'user_id' => rand(1, 6),
        'slug' => Str::slug($faker->sentence() . '-' . $faker->paragraph(10)),
        'result' => $faker->paragraph(10),
        'request' => $faker->sentence(),
        'is_visited' => '1',
        'username' => $faker->userName,
    ];
});
