<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePacsSupportRequest extends FormRequest
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
            'pacs_installation' => ['integer', 'required'],
            'hospital_personel' => ['string', 'required'],
            'report_date' => ['date', 'required'],
            'report_time' => ['required'],
            'problem' => ['string', 'required'],
            'solve' => ['string', 'required'],
            'solve_date' => ['date', 'required'],
            'solve_time' => ['required'],
        ];
    }
}
