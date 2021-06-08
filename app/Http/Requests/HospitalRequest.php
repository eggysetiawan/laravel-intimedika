<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalRequest extends FormRequest
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
            'name' => 'required|string|max:191',
            'phone' => 'required|numeric',
            'city' => 'required|string|max:191',
            'address' => 'required|string',
            'email' => 'nullable|unique:hospitals,email|max:191',
            'class' => 'nullable',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nama Rumah Sakit wajib diisi!',
            'phone.required' => 'Nomor Tlp wajib diisi!',
            'city.required' => 'Kota wajib diisi!',
            'address.required' => 'Alamat wajib diisi!',
        ];
    }
}
