<?php

namespace App\Http\Livewire\Customers;

use App\Hospital;
use Livewire\Component;

class Create extends Component
{

    public $name,
        $mobile,
        $person_in_charge,
        $role,
        $email,
        $address,
        $hospital,
        $hospital_name;

    protected $requiredHospital;

    public $showHospital;
    public $hasHospital;

    public $listeners = [
        'hospitalSelected' => 'changeForm',
        'showHospital',
        'hideHospital'
    ];

    protected $validationAttributes = [
        'hospital' => 'Rumah Sakits',
        'hospital_name' => 'Rumah Sakit nama',
        'role' => 'Jabatan',
        'email' => 'Email',
        'name' => 'Perusahaan/Institusi',
        'mobile' => 'Nomor Handphone',
        'address' => 'Alamat',
    ];

    public function changeForm($value)
    {
        $this->showHospital = true;
        // $hospitals = Hospital::find($value);


        $hospitals = Hospital::with('customers.author')->where('id', $value)->first();

        if (@$hospitals->customers->first()->author->name) {
            $this->resetErrorBag('hospital');
            $this->addError('hospital',   'Rumah Sakit telah menjadi customer ' . $hospitals->customers->first()->author->name);
            $this->hospital = null;
            $this->hospital_name = $hospitals->name;

            // $this->requiredField('hospital', 'Rumah Sakit');
            // $this->requiredField('name', 'Nama');
            // $this->requiredField('mobile', 'Nomor Handphone');
            // $this->requiredField('person_in_charge', 'Nama PIC');
            // $this->requiredField('role', 'Jabatan');
        } else {
            $this->hospital = $hospitals->id;
            $this->hospital_name = $hospitals->name;
            $this->resetErrorBag('hospital');

            // $this->requiredField('name', 'Nama');
            // $this->requiredField('mobile', 'Nomor Handphone');
            // $this->requiredField('person_in_charge', 'Nama PIC');
            // $this->requiredField('role', 'Jabatan');
        }
    }

    public function hideHospital()
    {
        $this->showHospital = false;
        $this->requiredHospital = null;
    }
    public function showHospital()
    {
        $this->showHospital = true;
    }

    public function requiredField($field, $name)
    {
        if (!$this->$field) {
            return $this->addError($field, $name . ' wajib diisi.');
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'hospital_name' => ['filled'],
            'hospital' => ['integer', 'nullable'],
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
        $this->showHospital = true;
        $this->hasHospital = true;
        $this->requiredHospital = 'ab';

        if ($this->requiredHospital) {
            $this->requiredHospital = $this->requiredField('hospital', 'Rumah Sakit');
        }

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
