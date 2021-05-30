<?php

namespace App\Http\Livewire\Customers;

use Livewire\Component;

class Create extends Component
{

    public $name,
        $mobile,
        $person_in_charge,
        $role,
        $email,
        $address;

    protected $validationAttributes = [
        'hospital' => 'Rumah Sakit',
        'role' => 'Jabatan',
        'email' => 'Email',
        'name' => 'Perusahaan/Institusi',
        'mobile' => 'Nomor Handphone',
        'address' => 'Alamat',
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
            'name' => ['min:3', 'string', 'required'],
            'mobile' => ['digits_between:9,13', 'required'],
            'person_in_charge' => ['min:3', 'string', 'required'],
            'role' => ['min:5', 'string', 'required'],
            'email' => ['email', 'present', 'unique:customers,email'],
            'address' => ['present', 'string'],
        ]);
    }

    public function mount()
    {
        $this->name = old('name');
        $this->requiredField('name', 'Nama');
        $this->requiredField('mobile', 'Nomor Handphone');
        $this->requiredField('person_in_charge', 'Nama PIC');
        $this->requiredField('role', 'Jabatan');
    }
    public function render()
    {
        return view('livewire.customers.create');
    }
}
