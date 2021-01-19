<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModalityRequest extends FormRequest
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
            'name' => 'required',
            'model' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'reference' => 'required',
            'price' => 'required|numeric',
            'spec' => 'nullable|string',
            'stock' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Alat wajib diisi!',
            'model.required' => 'Model Alat wajib diisi!',
            'brand.required' => 'Brand Alat wajib diisi!',
            'price.required' => 'Harga Alat wajib diisi atau berikan nilai 0!',
            'category.required' => 'Pilih kategori alat!',
            'reference.required' => 'Pilih referensi alat!',
            'price.numeric' => 'Harga Alat hanya berupa angka!',
            'stock.required' => 'Silahkan berikan nilai 0 jika stok kosong!',
        ];
    }
}
