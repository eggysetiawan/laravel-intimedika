<?php

namespace App\Http\Livewire\Customers;

use Livewire\Component;

class Create extends Component
{

    public $name, $hospital;



    public $nohospital = false;


    public function requiredField($field, $name)
    {
        if (!$this->$field) {
            return $this->addError($field, $name . ' wajib diisi!');
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => ['min:5'],
        ]);
    }


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
        $this->requiredField('name', 'Nama');
    }
    public function render()
    {
        return view('livewire.customers.create');
    }
}
