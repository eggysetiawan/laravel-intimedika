<?php

namespace App\Http\Livewire\Customers;

use App\Customer;
use Livewire\Component;

class Edit extends Component
{
    public $name,
        $mobile,
        $person_in_charge,
        $role,
        $email,
        $address,
        $hospital,
        $hospital_name;

    protected $requiredHospital;

    public $hasHospital = true;

    public function mount(Customer $customer)
    {
        $this->hasHospital = false;
        $this->name = $customer->name;
    }

    public function render()
    {
        return view('livewire.customers.edit');
    }
}
