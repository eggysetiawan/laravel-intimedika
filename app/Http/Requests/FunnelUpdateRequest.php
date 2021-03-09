<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FunnelUpdateRequest extends FormRequest
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
            'modality.*' => 'nullable',
            'references.*' => 'nullable',
            'price.*' => 'nullable',
            'progress' => 'numeric|min:10',
            'description' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'reference' => 'Referensi',
            'price' => 'Harga',
        ];
    }
}
