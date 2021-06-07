<?php

use App\Migration\Media;
use Illuminate\Database\Seeder;

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


        foreach ($medias as $media) {
            $model = $media->model_type;

            $mediaInsert = $model::find($media->model_id);

            $mediaInsert
                ->addMedia(storage_path('MigrasiMedia/' . $media->id . '/' . $media->file_name))
                ->preservingOriginal()
                ->usingFileName($media->file_name)
                ->toMediaCollection($media->collection_name);
        }
    }
}
