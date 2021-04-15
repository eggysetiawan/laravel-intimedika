<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hospital;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Hospital::class, function (Faker $faker) {
    $types = ['A', 'B', 'C', 'D', 'E'];
    $randTypes = array_rand($types);

    return [
        'name' => $faker->company(),
        'code' => rand(1000, 9999),
        'slug' => Str::slug($faker->company()),
        'phone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'address' => $faker->address,
        'city' => $faker->city,
        'type' => $types[$randTypes],
    ];
});
