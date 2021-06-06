<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medias = Media::get();
        $model_id = $medias->pluck('model_id')->toArray();
        $model_type = $medias->pluck('model_type')->toArray();
        $user = [];
        foreach ($model_id as $id) {
            $user[] = $id;
        }
        dd($model_type);
    }
}
