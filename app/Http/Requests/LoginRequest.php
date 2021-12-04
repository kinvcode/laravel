<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'email' => [
                'required',
                'regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/',
                'max:100',
                'exists:users'
            ],
            'password' => ['required', 'regex:/^(?=.*[A-Z])(?=.*[a-z])[0-9a-zA-Z!@#$%^&*,\\.]{8,15}$/'],
        ];
    }
}
