<?php

namespace App\Http\Livewire\Visits;

use App\Hospital as AppHospital;
use Livewire\Component;

class Hospital extends Component
{

    public $hospital,
        $isVisited = false;

    protected $validationAttributes = [
        'hospital' => 'Rumah Sakit',
    ];

    // public $nohospital = false;
    public $listeners = [
        'selectedHospitalVisited',
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
    }


    // select2
    public function hydrate()
    {
        $this->emit('select2');
    }



    public function selectedHospitalVisited($item)
    {
        $hospital =  AppHospital::query();
        $isHospital = $hospital->whereHas('customers')->where('id', $item)->exists();
        if (!$isHospital) {
            $this->isVisited = false;
            $this->hospital =  null;
        }
        $this->isVisited = true;
        $this->hospital =  AppHospital::find($item)->id;
    }

    public function render()
    {
        return view('livewire.visits.hospital');
    }
}
