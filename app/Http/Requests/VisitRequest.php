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
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi!',
            'mobile.required' => 'Nomor Hp wajib diisi!',
            'result.required' => 'Hasil kunjungan wajib diisi!',
            'request.required' => 'Permintaan kunjungan wajib diisi!',
        ];
    }
}
