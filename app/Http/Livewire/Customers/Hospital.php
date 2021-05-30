<?php

namespace App\Http\Livewire\Customers;

use App\Hospital as Model;
use Livewire\Component;

class Hospital extends Component
{
    public $hospital;
    protected $listeners = [
        'selectedHospitalItem',
    ];
    public function hydrate()
    {
        $this->emit('select2');
    }

    public function selectedHospitalItem($item)
    {
        if ($item) {
            $this->hospital = Model::find($item);
            $this->emit('selectedHospitalId', $this->hospital->id);
        } else {
            $this->hospital = null;
        }
    }

    public function render()
    {
        return view('livewire.customers.hospital');
    }
}
