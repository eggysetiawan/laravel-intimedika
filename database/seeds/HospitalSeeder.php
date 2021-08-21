<?php

use App\Hospital;
use App\Migration\Hospital as MigrationHospital;
use App\RumahSakit;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $hospitals = MigrationHospital::all();

        // foreach ($hospitals as $hospital) {
        //     Hospital::create([
        //         'id' => $hospital->id,
        //         'name' => $hospital->name,
        //         'slug' => $hospital->slug,
        //         'code' => $hospital->code ?? null,
        //         'phone' => $hospital->phone,
        //         'email' => $hospital->email ?? null,
        //         'address' => $hospital->address,
        //         'city' => $hospital->city,
        //     ]);
        // }
        // from factory
        factory(Hospital::class, 100)->create();

    }
}
