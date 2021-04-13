<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'customer' => 'integer|required',
            'budget' => 'required',
            'price_note' => 'nullable',
            'warranty_note' => 'nullable',
            'availability_note' => 'nullable',
            'note' => 'nullable',
            'date' => 'date',
            'queue' => 'required|numeric|min:1',
            'modalities' => 'required',
            'modalities.*' => 'required|distinct',
            'references.*' => 'nullable',
            'price.*' => 'integer|nullable',
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
