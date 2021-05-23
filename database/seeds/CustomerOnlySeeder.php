<?php

use App\User;
use App\Customer;
use App\Hospital;
use App\SalesCustomer;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CustomerOnlySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sales_customer = SalesCustomer::query()
            ->get();

        foreach ($sales_customer as $customer) {

            $username = 1;
            if (User::where('username', $customer->username)->first()) {
                $username = User::where('username', $customer->username)->first()->id;
            }


            if ($customer->fk_rs) {
                $hospital = Hospital::where('id', $customer->fk_rs)->first()->id;
            }

            if ($customer->email_cust == '') {
                $customer->email_cust = null;
            }

            if ($customer->email_cust == "-") {
                $customer->email_cust = null;
            }

            if (Customer::where('email', 'rafli@intimedika.co')->exists()) {
                $customer->email_cust = uniqid('email') . '@intimedika.co';
            }

            if (Customer::where('email', 'haryani.tri7521@gmail.com')->exists()) {
                $customer->email_cust = uniqid('email') . '@intimedika.co';
            }

            $slug = $customer->nama_cust;
            if ($customer->nama_cust == '-') {
                $slug = $customer->rs_cust;
            }



            $customers = Customer::create([
                'id' => $customer->pk_cust,
                'user_id' => $username,
                'slug' => Str::slug(uniqid('cust') . '-' . $slug),
                'name' => $customer->nama_cust,
                'person_in_charge' => $customer->nama_cust,
                'mobile' => $customer->hp_cust,
                'role' => $customer->jabatan_cust,
                'city' => $customer->kota_cust,
                'address' => $customer->alamat_cust,
                'email' => $customer->email_cust,

            ]);
            if ($customer->fk_rs) {
                $customers->hospitals()->attach($hospital);
            }
        }
    }
}
