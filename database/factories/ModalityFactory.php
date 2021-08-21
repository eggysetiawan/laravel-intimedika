<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modality;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Modality::class, function (Faker $faker) {
    $modalitiesName = ['Intiwid RIS PACS', 'Salient S', 'Salient D', 'MRI', 'Stellant D', 'Injector', 'AJAX', 'Mini PACS', 'Mini RIS PACS', 'Careray Flat Pannel'];
    $randModalitiesName = array_rand($modalitiesName);

    $brands = ['AGFA', 'Iradimed', 'Bayer', 'Careray'];
    $randBrands = array_rand($brands);

    $categories = ['BHP', 'Modality', 'Software'];
    $randCategories = array_rand($categories);

    $references = ['E-Catalogue', 'Non E-Catalogue'];
    $randReferences = array_rand($references);


    return [
        'name' => $modalitiesName[$randModalitiesName],
        'slug' => Str::slug($modalitiesName[$randModalitiesName] . '-' . Str::random(6)),
        'model' => $faker->word,
        'brand' => $brands[$randBrands],
        'price' => rand(100000, 1000000000),
        'unit' => $faker->word,
        'spec' => $faker->sentence(50),
        'stock' => rand(1, 40),
        'category' => $categories[$randCategories],
        'reference' => $references[$randReferences],
    ];
});
