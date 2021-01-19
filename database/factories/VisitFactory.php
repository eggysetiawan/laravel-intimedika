<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Visit;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Visit::class, function (Faker $faker) {
    return [
        'customer_id' => rand(1, 3),
        'slug' => Str::slug($faker->sentence()),
        'result' => $faker->paragraph(10),
        'request' => $faker->sentence(),
        'username' => 'eggysetiawan',
    ];
});
