<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hospital;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Faker\Provider\en_US\Company;

$factory->define(Hospital::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'slug' => Str::slug($faker->sentence()),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'city' => $faker->city,
    ];
});
