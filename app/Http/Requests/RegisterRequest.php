<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191'],
            'position' => ['required', 'string', 'max:191'],
            'username' => ['required', 'string', 'max:25'],
            'role' => ['required', Rule::In(['sales', 'teknisi', 'admin', 'supervisor', 'it'])],
            'phone' => ['required', 'max:15'],
            'email' => ['required', 'email', 'unique:users,email', 'unique:users', 'max:191'],
            'password' => ['required', 'string', 'min:4', 'confirmed', 'max:191'],
            'terms' => ['accepted'],
        ];
    }
}
