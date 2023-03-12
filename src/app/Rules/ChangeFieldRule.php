<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ChangeFieldRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $field;
    private int $status;

    public function __construct($field, int $status)
    {
        $this->field = $field;
        $this->status = $status;
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
        if ($this->status !== 1) {
            return $this->field == $value;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'нельзя изменять :attribute';
    }
}
