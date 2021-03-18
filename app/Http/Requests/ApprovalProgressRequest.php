<?php

namespace App\Http\Requests;

use App\Rules\PinApproval;
use Illuminate\Foundation\Http\FormRequest;

class ApprovalProgressRequest extends FormRequest
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
            'approval' => 'integer|required',
            'pin_purchase' => new PinApproval,
        ];
    }
}
