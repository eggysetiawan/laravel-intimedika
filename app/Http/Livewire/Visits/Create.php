<?php

namespace App\Http\Livewire\Visits;

use App\Hospital;
use Livewire\Component;

class Create extends Component
{
    public $hospitals = [];
    public $hospital;
    public $label;

    public function mount()
    {
        $this->label = '';
        $this->hospitals = Hospital::hospitalBlade();
    }

    public function updatedHospital($value)
    {
        return $this->label = 'Berhasil';
    }

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function render()
    {
        return view('livewire.visits.create');
    }
}
