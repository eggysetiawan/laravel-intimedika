<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 6),
        'slug' => $faker->slug(),
        'name' => $faker->name,
        'mobile' => $faker->phoneNumber,
        'role' => $faker->title,
        'city' => $faker->city,
        'address' => $faker->address,
        'email' => $faker->safeEmail,
    ];
});
