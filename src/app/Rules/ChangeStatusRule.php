<?php

namespace App\Rules;

use App\Models\Invoice;
use Illuminate\Contracts\Validation\Rule;

class ChangeStatusRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $invoice = Invoice::find($this->id);

        return $value >= $invoice->status_id;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'прошлое не обратимо';
    }
}
