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

        // from factory
        factory(Modality::class, 50)->create();
    }
}
