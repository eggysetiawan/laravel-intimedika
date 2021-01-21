<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitRequest extends FormRequest
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
            'result' => 'required',
            'request' => 'required',
            'name' => 'sometimes|required',
            'mobile' => 'sometimes|required',
            'role' => 'sometimes|required',
            'email' => 'sometimes|email|unique:customers,email',
            // 'hospital' => 'unique:customers,hospital_id',
            'img' => 'image|mimes:png,jpg,jpeg,svg|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'hospital.unique' => 'Rumah Sakit sudah pernah di Kunjungi oleh Sales lain!',
        ];
    }

    public function attributes()
    {
        return [
            'result' => 'Hasil Kunjungan',
            'request' => 'Permintaan Kunjungan',
            'name' => 'Nama',
            'mobile' => 'No Hp',
            'role' => 'Jabatan',
            'email' => 'Email',
            'hospital' => 'Rumah Sakit',
        ];
    }
}
