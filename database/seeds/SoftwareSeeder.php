<?php

use App\Migration\Software as MigrationSoftware;
use App\Software;
use App\User;
use Illuminate\Database\Seeder;

class SoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $softwares = MigrationSoftware::all();


        foreach ($softwares as $software) {
            $user = User::where('username', $software->username)->first();
            $user->softwares()->create([
                'id' => $software->pk_sw,
                'name' => $software->swversion,
                'modality_id' => $software->fk_mod,
            ]);
        }
    }
}
