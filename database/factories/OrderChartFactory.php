<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderChart;
use Faker\Generator as Faker;

$factory->define(OrderChart::class, function (Faker $faker) {
    $sales_names = ['Muhammad Saidi', 'Teten Sutendi', 'Eka Ariandi', 'Fahmi Fadli'];
    $randSales = array_rand($sales_names);

    $years = ['2020', '2021'];
    $randYear = array_rand($years);

    return [
        'sales_name' => 'M. Fahmi Fadli',
        'price' => round(rand(200000, 1000000000), -4),
        'is_approved' => rand(0, 1),
        'offer_date' => $faker->dateTimeInInterval($date = '-1 years', $invterval = '1 years'),
        'year' => $years[$randYear],
    ];
});
