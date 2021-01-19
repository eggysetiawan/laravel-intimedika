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
        ];
    }

    public function messages()
    {
        return [
            'role.required' => 'Jabatan wajib diisi!',
            'name.required' => 'Nama wajib diisi!',
            'mobile.required' => 'Nomor Hp wajib diisi!',
        ];
    }
}
