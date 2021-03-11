<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PinRequest extends FormRequest
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
            'pin' => 'min:4',
            'pin_confirmation' => 'required_with:pin|same:pin|min:4'
        ];
    }

    public function messages()
    {
        return [
            'pin_confirmation.same' => 'Pin yang ada masukan tidak sama!',
        ];
    }
}
