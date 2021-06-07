<?php

use App\Migration\PacsEngineer;
use App\PacsEngineer as AppPacsEngineer;
use Illuminate\Database\Seeder;

class PacsEngineerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $engineers = PacsEngineer::get();

        foreach ($engineers as $engineer) {
            AppPacsEngineer::create([
                'engineerable_id' => $engineer->engineerable_id,
                'engineerable_type' => $engineer->engineerable_type,
                'user_id' => $engineer->user_id,
                'created_at' => $engineer->created_at,
                'updated_at' => $engineer->updated_at,
                'deleted_at' => $engineer->deleted_at,
            ]);
        }
    }
}
