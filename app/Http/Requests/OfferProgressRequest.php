<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferProgressRequest extends FormRequest
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
            'progress' => 'nullable|required',
            'status' => 'string|required',
            'detail' => 'string|required',
            'demo_date' => 'required_if:progress,99',
            'description' => 'required_if:progress,50',
            'price_po' => 'required_if:progress,99',
            'shipping' => 'required_if:progress,99',
            'img' => 'required_if:progress,99|mimes:png,jpg,jpeg',
        ];
    }
}
