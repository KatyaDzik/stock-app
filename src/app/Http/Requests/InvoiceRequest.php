<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'number' => ['required', 'digits:9'],
            'date' => ['required'],
            'from' => ['required', 'min:5'],
            'to' => ['required', 'min:5'],
            'status_id' => ['required', 'exists:statuses,id'],
            'provider_id' => ['required', 'exists:providers,id'],
            'customer_id' => ['required', 'exists:customers,id'],
            'type_id' => ['required', 'exists:invoice_types,id']
        ];
    }
}
