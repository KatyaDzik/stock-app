<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use App\Rules\ChangeFieldRule;
use App\Rules\ChangeStatusRule;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceUpdateRequest extends FormRequest
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
        $invoice = Invoice::find($this->route('invoice'));
        return [
            'number' => ['required', 'digits:9', new ChangeFieldRule($invoice->number, $invoice->status_id)],
            'date' => ['required', new ChangeFieldRule($invoice->date, $invoice->status_id)],
            'from' => ['required', 'min:5', new ChangeFieldRule($invoice->from, $invoice->status_id)],
            'to' => ['required', 'min:5', new ChangeFieldRule($invoice->to, $invoice->status_id)],
            'status_id' => ['required', 'exists:statuses,id', new ChangeStatusRule($this->route('invoice'))],
            'provider_id' => ['required', 'exists:providers,id', new ChangeFieldRule($invoice->provider_id, $invoice->status_id)],
            'customer_id' => ['required', 'exists:customers,id', new ChangeFieldRule($invoice->customer_id, $invoice->status_id)],
            'type_id' => ['required', 'exists:invoice_types,id', new ChangeFieldRule($invoice->type_id, $invoice->status_id)]
        ];
    }
}
