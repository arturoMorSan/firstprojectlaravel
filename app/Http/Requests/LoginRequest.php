<?php

namespace App\Http\Requests;

class LoginRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:5' // password can only be alphanumeric and has to be greater than 3 characters
        ];
    }
}
