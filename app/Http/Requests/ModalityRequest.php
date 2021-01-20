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
            'price' => 'filled|numeric',
            'spec' => 'nullable|string',
            'stock' => 'filled|numeric',
        ];
    }

    public function messages()
    {
        return [

            'price.filled' => 'Harga Alat harus memiliki nilai atau berikan nilai 0!',
            'stock.filled' => 'Silahkan berikan nilai 0 jika stok kosong!',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama Alat',
            'model' => 'Model',
            'brand' => 'Merk',
            'category' => 'Kategori',
            'reference' => 'Referensi',
            'price' => 'Harga',
            'spec' => 'Spesifikasi',
            'stock' => 'Stok',
        ];
    }
}
