<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
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
            'service_tag' => ['nullable', 'string', 'max:191', 'required_without:serial_number'],
            // 'department' => ['integer', 'required'],
            'serial_number' => ['nullable', 'string', 'max:191', 'required_without:service_tag'],
            'item' => ['required', 'string', 'max:191'],
            'user' => ['string', 'nullable', 'max:191', 'required'],
            'quantity' => ['required'],
            'type' => ['required'],
            'location' => ['nullable'],
            'purchase_date' => ['nullable'],
            'note' => ['nullable', 'string']
        ];
    }

    public function attributes()
    {
        return [
            'service_tag' => 'Service Tag',
            // 'department' => 'Department/Divisi',
            'serial_number' => 'Serial Number',
            'item' => 'Nama Barang',
            'user' => 'Nama User',
            'quantity' => 'Jumlah Barang',
            'type' => 'Jenis Barang',
            'location' => 'Lokasi Barang',
            'purchase_date' => 'Tanggal Pembelian Barang',
            'note' => 'Catatan Barang',
        ];
    }
}
