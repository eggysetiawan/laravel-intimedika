<?php

namespace App\Http\Livewire\DailyJobs;

use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $date, $description, $img;

    protected $validationAttributes = [
        'description' => 'Deskripsi',
        'date' => 'Tanggal Laporan',
        'img' => 'File',
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
            'date' => ['required', 'date'],
            'description' => ['required', 'min:6'],
            'img' => ['nullable', 'mimes:zip,rar', 'max:100000000'],
        ]);
    }

    public function mount()
    {
        $this->date = date('Y-m-d');
        $this->requiredField('description', 'Deskripsi');
    }

    public function render()
    {
        return view('livewire.daily-jobs.create');
    }
}
