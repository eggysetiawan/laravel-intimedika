<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferNoteRequest extends FormRequest
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
            'has_form_note' => ['sometimes'],
            'form_note' => ['required'],
            'form_up' => ['sometimes'],
            'name_up' => ['required_if:form_up,on'],
        ];
    }
}
