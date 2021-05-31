<?php

use App\Customer;
use App\Hospital as AppHospital;
use App\Http\Livewire\Customers\Hospital;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $customers = Customer::whereHas('hospitals', function ($query) {
        //     return $query->where('hospital_id', 6674)->first();
        // });
        // dd($customers);
        $hospitals = AppHospital::whereHas('customers')->where('id', 4063)->exists();
        dd($hospitals);
    }
}
