<?php

namespace App\Http\Livewire\DailyJobs;

use Livewire\Component;

class Create extends Component
{
    public $date, $description, $img;

    protected $validationAttributes = [
        'description' => 'Deskripsi',
        'date' => 'Tanggal Laporan',
    ];

    public function requiredField($field)
    {
        $fields = str_replace('description', 'Deskripsi', $field);
        if (!$this->$field) {
            return $this->addError($field, $fields . ' wajib diisi!');
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'date' => ['required', 'date'],
            'description' => ['required', 'min:6'],
            'img' => ['nullable', 'mimes:zip,rar'],
        ]);
    }

    public function mount()
    {
        $this->date = date('Y-m-d');
        $this->requiredField('description');
    }

    public function render()
    {
        return view('livewire.daily-jobs.create');
    }
}
