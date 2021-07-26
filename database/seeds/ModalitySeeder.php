<?php

use App\Modality;
use App\SalesModality;
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
    public function run()
    {
        // $modalities = SalesModality::all();

        // foreach ($modalities as $modality) {

        //     switch (strtolower($modality->jenis_mod)) {
        //         case 'bhp':
        //             $unit = 'pce';
        //             break;

        //         default:
        //             $unit = 'unit';
        //             break;
        //     }

        //     Modality::create([
        //         'id' => $modality->pk_mod,
        //         'name' => $modality->nama_mod,
        //         'slug' => Str::slug($modality->nama_mod),
        //         'model' => $modality->model_mod,
        //         'brand' => $modality->merk_mod,
        //         'price' => $modality->harga_mod,
        //         'unit' => $unit,
        //         'spec' => $modality->spek_mod,
        //         'stock' => $modality->stock_mod,
        //         'category' => strtolower($modality->jenis_mod),
        //         'reference' => $modality->type_mod,

        //     ]);
        // }

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
