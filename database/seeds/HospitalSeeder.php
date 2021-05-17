<?php

use App\Hospital;
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
        // $hospitals = RumahSakit::all();

        // foreach ($hospitals as $hospital) {
        //     Hospital::create([
        //         'id' => $hospital->pk_rs,
        //         'name' => $hospital->nama_rs,
        //         'slug' => Str::slug($hospital->nama_rs),
        //         'code' => $hospital->kode_rs ?? null,
        //         'phone' => $hospital->telepon_rs,
        //         'email' => $hospital->email_rs ?? null,
        //         'address' => $hospital->alamat_rs,
        //         'city' => $hospital->kota_rs,
        //     ]);
        // }
        factory(Hospital::class, 100)->create();
    }
}
