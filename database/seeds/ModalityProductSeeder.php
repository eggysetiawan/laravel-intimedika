<?php

use App\Migration\Product;
use App\Modality;
use Illuminate\Database\Seeder;

class ModalityProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::get();

        foreach ($products as $product) {
            $modality = Modality::where('id', $product->fk_mod)->first();

            $modality
                ->addMedia(public_path('image/modality/' . $product->images))
                ->preservingOriginal()
                ->toMediaCollection('product');
        }
    }
}
