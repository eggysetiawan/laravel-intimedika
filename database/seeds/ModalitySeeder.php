<?php

use App\Modality;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker = Faker::create('id_ID');
        $modalitiesName = ['Intiwid RIS PACS', 'Salient S', 'Salient D', 'MRI', 'Stellant D', 'Injector', 'AJAX', 'Mini PACS', 'Mini RIS PACS', 'Careray Flat Pannel'];
        $brands = ['AGFA', 'Iradimed', 'Bayer', 'Careray'];
        $categories = ['BHP', 'Modality', 'Software'];
        $referenfes = ['E-Catalogue', 'Non E-Catalogue'];

        foreach ($modalitiesName as $modalityname) {
            $randCategories = array_rand($categories);
            $randReferences = array_rand($referenfes);
            $randBrands = array_rand($brands);
            Modality::insert([
                'name' => $modalityname,
                'slug' => Str::slug($modalityname),
                'model' => $faker->word,
                'brand' => $brands[$randBrands],
                'price' => rand(100000, 999999999),
                'spec' => $faker->sentence(),
                'stock' => rand(1, 99),
                'category' => $categories[$randCategories],
                'reference' => $referenfes[$randReferences],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);
        }
    }
}
