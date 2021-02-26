<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitPlanRequest extends FormRequest
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
            'name' => 'nullable',
            'mobile' => 'nullable',
            'hospital' => 'required',
            'date' => 'date|after_or_equal:' . date('d-m-Y'),
            'email' => 'unique:customers,email|nullable',
            'description' => 'required',
            'territory' => 'nullable',
            'area' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama Customer',
            'mobile' => 'Hp/Telp.',
            'hospital' => 'Rumah Sakit',
            'date' => 'Tanggal',
            'email' => 'Alamat Email',
            'description' => 'Aktifitas Rencana Kunjungan',
            'territory' => 'Ruangan/Bagian',
            'area' => 'Area',
        ];
    }
}
