<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegistrationRequest extends FormRequest
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
            'email'   => 'required|email|unique:users,email',
            'name'    => ['required', 'string', 'max:255', 'min:4', 'unique:users,name'],
            'password'=> ['required', 'confirmed', Password::min(8)->letters()],
        ];
    }
}
