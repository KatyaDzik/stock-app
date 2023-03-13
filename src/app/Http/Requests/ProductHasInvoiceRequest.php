<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductHasInvoiceRequest extends FormRequest
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
            'count' => ['required', 'numeric'],
            'nds' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'product_id' => ['required', 'exists:products,id'],
            'invoice_id' => ['required', 'exists:invoices,id']
        ];
    }
}
