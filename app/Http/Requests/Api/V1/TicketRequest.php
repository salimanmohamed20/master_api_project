<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required'],
            'description' => ['required'],
            'status' => ['required'],
            'user_id' => ['required', 'exists:users'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
