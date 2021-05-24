<?php

use App\User;
use App\Visit;
use App\Customer;
use App\Hospital;
use App\SalesKunjungan;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Visit::class, 50)->create();

        $sales_kunjungan = SalesKunjungan::query()
            ->whereNotNull('fk_rs')
            ->where('fk_rs', '!=', '')
            ->get();

        foreach ($sales_kunjungan as $kunjungan) {
            $fk_rs = $kunjungan->fk_rs;
            $hospitals = Hospital::with('customers')->where('id', $fk_rs)->first();
            if ($hospitals->customers->first()) {
                $customer_id = $hospitals->customers->first()->id;

                $username = 1;
                if (User::where('username', $kunjungan->username)->first()) {
                    $username = User::where('username', $kunjungan->username)->first()->id;
                }

                Visit::create([
                    'id' => $kunjungan->pk_kunjungan,
                    'customer_id' => $customer_id,
                    'user_id' => $username,
                    'slug' => Str::slug(uniqid('visit-') . '-' . $kunjungan->req_kunjungan),
                    'request' => $kunjungan->req_kunjungan,
                    'result' => $kunjungan->hasil_kunjungan,
                    'is_visited' => 1,
                    'created_at' => $kunjungan->now_kunjungan,
                    'updated_at' => $kunjungan->now_kunjungan,
                ]);
            }
        }
    }
}
