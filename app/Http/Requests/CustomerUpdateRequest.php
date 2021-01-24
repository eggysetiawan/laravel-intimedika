<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'email' => 'email|required|sometimes',
            'name' => 'required|string',
            'mobile' => 'required|numeric',
            'address' => 'string',
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
}
