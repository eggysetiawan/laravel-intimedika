<?php

namespace App\Http\Livewire\Customers;

use Livewire\Component;

class Create extends Component
{
    public $nohospital = false;

    public function hideHospital()
    {
        $this->nohospital = true;
    }

    public function showHospital()
    {
        $this->nohospital = false;
    }

    public function mount()
    {
        $this->nohospital = false;
    }
    public function render()
    {
        return view('livewire.customers.create');
    }
}
