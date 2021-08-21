<?php

use App\User;
use App\Visit;
use App\Customer;
use App\Hospital;
use App\SalesKunjungan;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Customer::class, 50)->create();


        // $sales_kunjungan = SalesKunjungan::query()
        //     ->whereNotNull('fk_rs')
        //     ->get();

        // foreach ($sales_kunjungan as $kunjungan) {
        //     $username = User::where('username', $kunjungan->username)->first()->id;
        //     $hospital = Hospital::where('name', $kunjungan->rs_kunjungan)->first()->id;

        //     if ($kunjungan->email_kunjungan == '') {
        //         $kunjungan->email_kunjungan = null;
        //     }



        //     $customers = Customer::create([
        //         'user_id' => $username,
        //         'slug' => Str::slug(uniqid('cust') . '-' . $kunjungan->rs_kunjungan),
        //         'name' => $kunjungan->nama_kunjungan,
        //         'person_in_charge' => $kunjungan->nama_kunjungan,
        //         'mobile' => $kunjungan->hp_kunjungan,
        //         'role' => $kunjungan->jabatan_kunjungan,
        //         'city' => $kunjungan->kota_kunjungan,
        //         'address' => $kunjungan->alamat_kunjungan,
        //         'email' => $kunjungan->email_kunjungan,

        //     ]);
        //     $customers->hospitals()->attach($hospital);

        //     Visit::create([
        //         'customer_id' => $customers->id,
        //         'user_id' => $username,
        //         'slug' => Str::slug(uniqid('visit') . '-' . $kunjungan->request),
        //         'request' => $kunjungan->req_kunjungan,
        //         'result' => $kunjungan->hasil_kunjungan,
        //         'is_visited' => 1,
        //         'created_at' => $kunjungan->now_kunjungan,
        //         'updated_at' => $kunjungan->now_kunjungan,
        //     ]);
        // }
    }
}
