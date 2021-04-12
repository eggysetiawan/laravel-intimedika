<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hospital;
use Faker\Generator as Faker;

$factory->define(Hospital::class, function (Faker $faker) {
    return [
        'name' => $faker->company(),
        'code' => $faker->unique()->randomDigit,
        'slug' => $faker->slug(),
        'phone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'address' => $faker->address,
        'city' => $faker->city,
        'type' => strtoupper($faker->randomElements()),
    ];
});
