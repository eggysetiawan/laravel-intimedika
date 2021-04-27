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
            'detail' => 'required_unless:progress,50',
            'demo_date' => 'required_if:progress,50',
            'description' => 'required_if:progress,50',
            'shipping' => 'nullable',
            'cn' => 'required|integer',
            'price.*' => 'nullable',
            'qty.*' => 'nullable',
            'img' => 'required_if:progress,99|mimes:png,jpg,jpeg',
        ];
    }

    public function messages()
    {
        return [
            'price_po.required_if' => "Harga Pre-Order wajib diisi!",
            'shipping.required_if' => "Ongkos kirim wajib diisi!",
            'detail.required' => "Keterangan wajib diisi!",
            'detail.required_unless' => "Keterangan wajib diisi!",
            'img.required_if' => "Bukti Purhcase Order wajib di upload!",
        ];
    }
}
