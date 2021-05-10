<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DailyJob;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(DailyJob::class, function (Faker $faker) {
    return [
        'user_id' => rand(13, 19),
        'title' => $faker->jobTitle,
        'slug' => Str::slug($faker->jobTitle . uniqid()),
        'description' => $faker->sentence(100),
        'date' => $faker->dateTimeThisYear(),
    ];
});
