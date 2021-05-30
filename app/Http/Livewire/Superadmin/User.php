<?php

namespace App\Http\Livewire\Superadmin;

use App\User as Model;
use Livewire\Component;

class User extends Component
{
    public $user;
    protected $listeners = [
        'selectedUserItem',
    ];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function selectedUserItem($item)
    {
        if ($item) {
            $this->user = Model::find($item);
            $this->emit('selectedUserId', $this->user->id);
        } else {
            $this->user = null;
        }
    }

    public function render()
    {
        return view('livewire.superadmin.user');
    }
}
