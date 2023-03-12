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
            'number' => ['required', 'digits:9', 'unique:invoices,number'],
            'date' => ['required'],
            'from' => ['required', 'min:5'],
            'to' => ['required', 'min:5'],
            'provider' => ['required', 'string', 'min:2', 'max:255'],
            'customer' => ['required', 'string', 'min:2', 'max:255'],
            'type_id' => ['required', 'exists:invoice_types,id']
        ];
    }
}
