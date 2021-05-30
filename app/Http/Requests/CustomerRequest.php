<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hospital' => ['required', 'integer'],
            'name' => ['min:3', 'string', 'required'],
            'mobile' => ['digits_between:9,13', 'required'],
            'person_in_charge' => ['min:3', 'string', 'required'],
            'role' => ['min:5', 'string', 'required'],
            'email' => ['present'],
            'address' => ['present'],
        ];
    }

    public function attributes()
    {
        return [
            'hospital' => 'Rumah Sakit',
            'role' => 'Jabatan',
            'email' => 'Email',
            'name' => 'Perusahaan/Institusi',
            'mobile' => 'Nomor Handphone',
            'address' => 'Alamat',
        ];
    }

    // public function messages()
    // {
    //     [
    //         'hospital.unique' => 'Rumah Sakit ini sudah pernah dikunjungi oleh sales lain!',
    //     ];
    // }
}
