<?php

namespace App\Http\Livewire\Customers;

use App\Hospital as Model;
use Livewire\Component;

class Hospital extends Component
{
    public $hospital;
    public $nohospital;

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
            'hospital' => ['nullable'],
        ]);
    }

    public function mount()
    {
        $this->nohospital = false;
        $this->requiredField('hospital', 'Rumah Sakit');
    }


    // select2
    public function hydrate()
    {
        $this->emit('select2');
    }

    public function selectedHospitalItem($item)
    {
        // dd($item);
        $this->emit('hospitalSelected', $item);

        // if ($item) {
        //     $this->hospital = Model::find($item);
        //     $this->emit('hospitalSelected', $this->hospital->id);
        // } else {
        //     $this->hospital = null;
        // }
    }
    public function hideHospital()
    {
        $this->nohospital = true;
        $this->emit('hideHospital');
    }

    public function showHospital()
    {
        $this->nohospital = false;
        $this->emit('showHospital');
    }



    public function render()
    {
        return view('livewire.customers.hospital');
    }
}
