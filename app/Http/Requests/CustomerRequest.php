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
            'email' => 'email|unique:customers,email',
            'name' => 'required',
            'mobile' => 'required',
            'hospital' => 'unique:customers,hospital_id',
        ];
    }

    public function attributes()
    {
        return [
            'role' => 'Jabatan',
            'email' => 'Email',
            'name' => 'Nama',
            'mobile' => 'Nomor Hp',
            'hospital' => 'Rumah Sakit',
        ];
    }

    // public function messages()
    // {
    //     [
    //         'hospital.unique' => 'Rumah Sakit ini sudah pernah dikunjungi oleh sales lain!',
    //     ];
    // }
}
