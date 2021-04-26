<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferFunnelRequest extends FormRequest
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
            'queue' => 'required|numeric|min:1',
            'date' => 'date',
            'customer' => 'integer|required',
            'budget' => 'required',
            'price_note' => 'nullable',
            'warranty_note' => 'nullable',
            'availability_note' => 'nullable',
            'note' => 'nullable',
            'modality' => 'required',
            'modality.*' => 'required|distinct',
            'references.*' => 'nullable',
            'price.*' => 'required',
            'user' => ['integer', 'nullable'],
        ];
    }

    public function attributes()
    {
        return [
            'customer' => 'Pelanggan',
            'budget' => 'Sumber Dana',
            'references' => 'Referensi',
            'modality' => 'Alat Kesehatan',
            'quantity' => 'Kuantitas',
            'price' => 'Harga',
            'price_note' => 'Catatan Harga',
            'warranty_note' => 'Garansi',
            'availability_note' => 'Ketersediaan',
            'note' => 'Keterangan',
        ];
    }
}
