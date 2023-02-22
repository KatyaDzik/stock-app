<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function Symfony\Component\Translation\t;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'login' => ['required', 'string', 'min:2', 'max:255'],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['required', 'min:4', 'max:255'],
            'password_confirmed' => ['required', 'same:password'],
        ];
    }
}
