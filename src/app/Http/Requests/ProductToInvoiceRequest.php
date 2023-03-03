<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductToInvoiceRequest extends FormRequest
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
            'count' => ['required'],
            'nds' => ['required'],
            'price' => ['required'],
            'product_id' => ['required', 'exists:products,id'],
            'invoice_id' => ['required', 'exists:invoices,id']
        ];
    }
}
