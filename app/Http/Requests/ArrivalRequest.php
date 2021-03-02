<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArrivalRequest extends FormRequest
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
            'result' => 'required|string',
            'request' => 'required|string',
            'role' => 'nullable',
            'img' => 'image|mimes:png,jpg,jpeg,svg',
        ];
    }

    public function attributes()
    {
        return [
            'result' => 'Hasil Kunjungan',
            'request' => 'Permintaan',
            'img' => 'Gambar',
        ];
    }
}
