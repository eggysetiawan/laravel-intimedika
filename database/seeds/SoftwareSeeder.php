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
            $user_id = User::where('username', $software->username)->first()->id;

            Software::create([
                'id' => $softwares->pk_sw,
                'name' => $softwares->swversion,
                'modality_id' => $user_id,
            ]);
        }
    }
}
