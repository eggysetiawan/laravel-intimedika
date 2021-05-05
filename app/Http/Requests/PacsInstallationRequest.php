<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacsInstallationRequest extends FormRequest
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
            'hospital' => ['integer', 'required', 'unique:pacs_installations,hospital_id'],
            'handover_date' => ['date'],
            'start_installation_date' => ['date', 'required'],
            'training_date' => ['nullable', 'date'],
            'finish_installation_date' => ['date', 'required'],
            'warranty_start' => ['date', 'required'],
            'warranty_end' => ['date', 'required'],
            'pacs_engineers.*' => ['nullable'],
            'it_hospital_name' => ['string', 'required'],
            'phone_it' => ['nullable'],
            'email_it' => ['nullable', 'email'],
            'radiographer_name' => ['string', 'required'],
            'phone_radiographer' => ['nullable'],
            'email_radiographer' => ['nullable', 'email'],
            'radiology_name' => ['string', 'required'],
            'phone_radiology' => ['nullable'],
            'email_radiology' => ['nullable', 'email'],
            'user_note' => ['string', 'nullable'],
        ];
    }
}
