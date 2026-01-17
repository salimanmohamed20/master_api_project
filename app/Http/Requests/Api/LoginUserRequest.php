<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [

            'email' => ['required', 'email', 'max:254'],
            'password' => ['required'],

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
