<?php

namespace App\Http\Livewire\Auth;

use App\User;
use Livewire\Component;

class Email extends Component
{
    public $email;
    public function requiredField($field, $name)
    {
        if (!$this->$field) {
            return $this->addError($field, $name . ' wajib diisi.');
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email' => ['email', 'required'],
        ]);

        $validEmail = User::where('email', $this->email)->exists();

        if (!$validEmail) {
            $this->addError('email', 'Email tersebut tidak cocok dengan data kami.');
        }
    }

    public function mount()
    {
        $this->requiredField('email', 'Email');
    }

    public function render()
    {
        return view('livewire.auth.email');
    }
}
