<?php

namespace App\Http\Requests;

use App\Rules\RepeatRule;
use App\Rules\RepeatRuleQty;
use App\Services\InvoiceService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RepeatRequest extends FormRequest
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
            'id_order.*' => 'integer|nullable',
            'price.*' => 'nullable',
            'qty.*' => 'nullable',
            'shipping' => 'nullable',
            'img' => 'image|mimes:png,jpg,pdf,jpeg',
        ];
    }
}
