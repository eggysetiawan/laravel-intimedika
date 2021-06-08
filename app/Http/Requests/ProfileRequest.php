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
            'position' => ['string', 'required', 'max:191'],
            'phone' => ['numeric', 'required', 'max:191'],
            'address' => ['string', 'required'],
            'city' => ['string', 'required', 'max:191'],
            'email' => ['required', 'email',  Rule::unique('users')->ignore($this->user->id, 'id'), 'max:191'],
        ];
    }
}
