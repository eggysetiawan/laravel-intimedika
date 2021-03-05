<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FunnelRequest extends FormRequest
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
            'customer' => 'integer|required',
            'date' => 'date|required',
            'modality.*' => 'nullable',
            'references.*' => 'nullable',
            'price.*' => 'nullable',
            'progress' => 'numeric|min:10',
        ];
    }
    public function attributes()
    {
        return [
            'date' => 'Tanggal',
            'reference' => 'Referensi',
            'price' => 'Harga',
        ];
    }
}
