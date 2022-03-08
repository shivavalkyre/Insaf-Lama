<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserregistrationRequest extends FormRequest
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
            'username' => 'required|min:5',
            'email' => 'required|email',
            'password' => ['required','required_with:confirmation_password','same:confirmation_password', Password::min(8), Password::min(8)->mixedCase(), Password::min(8)->symbols(), Password::min(8)->numbers()],
            'confirmation_password' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Username cannot be epmty',
            'username.min' => 'Username must be at least 5 characters or more',
            'email.required' => 'Email cannot be epmty',
            'email.email' => 'Invalid email address',
        ];
    }
}
