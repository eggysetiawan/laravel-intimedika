<?php

namespace App\Http\Livewire\Visits;

use App\Hospital;
use Livewire\Component;

class Create extends Component
{
    public $hospital, $hospitals = [];

    public function mount()
    {
        $this->hospitals = Hospital::hospitalBlade();
        $this->hospital = 'Pilih Rumah Sakit';

        $isVisited = Hospital::whereHas('customers')->where('id', $this->hospital)->exists();
    }

    public function changeEvent($value)
    {
        dd($value);
    }

    public function render()
    {
        return view('livewire.visits.create');
    }
}
