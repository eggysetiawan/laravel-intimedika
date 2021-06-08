<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvanceRequest extends FormRequest
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
            'destination' => ['string', 'required', 'max:191'],
            'objective' => ['string', 'required', 'max:191'],
            'start_date' => ['date', 'required'],
            'end_date' => ['date', 'required'],
            'needs.*' => ['required', 'distinct'],
            'days.*' => ['required', 'integer'],
            'notes.*' => ['required', 'string']
        ];
    }

    public function messages()
    {
        # code...
        return [
            'days.*.integer' => 'Jumlah hari harus berupa angka!',
        ];
    }
}
