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
            'anydesk_server' => ['nullable', 'max:191'],
            'anydesk_workstation' => ['nullable', 'max:191'],
            'hospital' => ['sometimes', 'integer', 'required', 'unique:pacs_installations,hospital_id'],
            'handover_date' => ['date'],
            'start_installation_date' => ['date', 'required'],
            'training_date' => ['nullable', 'date'],
            'finish_installation_date' => ['date', 'required'],
            'warranty_start' => ['date', 'required'],
            'warranty_end' => ['date', 'required'],
            'pacs_engineers.*' => ['sometimes', 'nullable'],
            'it_hospital_name' => ['string', 'required', 'max:191'],
            'phone_it' => ['nullable', 'max:191'],
            'email_it' => ['nullable', 'email', 'max:191'],
            'radiographer_name' => ['required', 'max:191'],
            'phone_radiographer' => ['nullable', 'max:191'],
            'email_radiographer' => ['nullable', 'email', 'max:191'],
            'radiology_name' => ['required', 'max:191'],
            'phone_radiology' => ['nullable', 'max:191'],
            'email_radiology' => ['nullable', 'email', 'max:191'],
            'user_note' => ['string', 'nullable'],
        ];
    }

    public function attributes()
    {
        return [
            'hospital' => 'Rumah Sakit',
            'handover_date' => 'Tanggal Serah Terima',
            'start_installation_date' => 'Tanggal mulai instalasi',
            'training_date' => 'Tanggal training',
            'finish_installation_date' => 'Tanggal instalasi selesai',
            'warranty_start' => 'Tanggal mulai garansi',
            'warranty_end' => 'Tanggal selesai garansi',
            'pacs_engineers.*' => ['nullable'],
            'it_hospital_name' => 'IT Rumah Sakit',
            'phone_it' => 'HP IT Rumah Sakit',
            'email_it' => 'Email IT Rumah Sakit',
            'radiographer_name' => 'Nama Radiographer',
            'phone_radiographer' => 'HP Radiographer',
            'email_radiographer' => 'Email Radiographer',
            'radiology_name' => 'Nama Dokter Radiologi',
            'phone_radiology' => ['nullable'],
            'email_radiology' => 'Email Dokter Radiologi',
            'user_note' => 'Keterangan Instalasi',
        ];
    }
}
