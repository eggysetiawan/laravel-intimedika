<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => ['string', 'required', 'min:2'],
            'initial' => ['string', 'max:3', 'required'],
            'position' => ['string', 'required'],
            'phone' => ['numeric', 'required'],
            'address' => ['string', 'required'],
            'city' => ['string', 'required'],
            'email' => ['required', 'email',  Rule::unique('users')->ignore($this->user->id, 'id')],
        ];
    }
}
