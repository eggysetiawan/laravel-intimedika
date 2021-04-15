<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 6),
        'name' => $faker->name,
        'mobile' => $faker->phoneNumber,
        'role' => $faker->jobTitle,
        'city' => $faker->city,
        'slug' => Str::slug($faker->name . '-' . $faker->city),
        'address' => $faker->address,
        'email' => $faker->safeEmail,
    ];
});
