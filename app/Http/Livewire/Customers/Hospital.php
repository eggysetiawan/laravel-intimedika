<?php

namespace App\Http\Livewire\Customers;

use App\Hospital as Model;
use Livewire\Component;

class Hospital extends Component
{
    public $hospital;
    public $nohospital = false;
    protected $validationAttributes = [
        'hospital' => 'Rumah Sakit',
    ];

    // public $nohospital = false;
    protected $listeners = [
        'selectedHospitalItem',
    ];

    public function requiredField($field, $name)
    {
        if (!$this->$field) {
            return $this->addError($field, $name . ' wajib diisi!');
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'hospital' => ['filled', 'integer'],
        ]);
    }

    public function mount()
    {
        $this->requiredField('hospital', 'Rumah Sakit');
    }


    // select2
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
            $this->hospital = 4000;
        }
    }
    public function hideHospital()
    {
        // dd('works');
        $this->nohospital = true;
    }

    public function showHospital()
    {
        $this->nohospital = false;
    }



    public function render()
    {
        return view('livewire.customers.hospital');
    }
}
