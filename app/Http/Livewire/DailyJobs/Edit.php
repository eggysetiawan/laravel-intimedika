<?php

namespace App\Http\Livewire\DailyJobs;

use Livewire\Component;

class Edit extends Component
{
    public $dailyJob,
        $date,
        $description,
        $img;

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
        $this->date = $this->dailyJob->date->format('Y-m-d');
        $this->description = $this->dailyJob->description;
    }
    public function render()
    {
        return view('livewire.daily-jobs.edit');
    }
}
