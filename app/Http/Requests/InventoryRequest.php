<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
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
            'service_tag' => ['nullable', 'string'],
            'department' => ['integer', 'required'],
            'serial_number' => ['nullable', 'string'],
            'item' => ['required', 'string'],
            'user' => ['string', 'nullable'],
            'quantity' => ['required'],
            'type' => ['required'],
            'location' => ['nullable'],
            'purchase_date' => ['nullable'],
            'note' => ['nullable', 'string']
        ];
    }
}
