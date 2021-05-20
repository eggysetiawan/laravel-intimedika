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
            'role' => 'required',
            'email' => 'nullable|unique:customers,email',
            'name' => 'required|string',
            'person_in_charge' => 'required',
            'mobile' => 'required|numeric',
            'address' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'role' => 'Jabatan',
            'email' => 'Email',
            'name' => 'Nama',
            'mobile' => 'Nomor Hp',
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
