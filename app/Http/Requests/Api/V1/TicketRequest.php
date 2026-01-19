<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules= [
            'data.attributes.title' => 'required|string',
            'data.attributes.description' => 'required|string',
            'data.attributes.status' => 'required:in:A,C,X,H',
  
            //
        ];
        if($this->routeIs('tickets.store')){
            $rules['data.relationships.author.data.id'] = 'required|exists:users,id';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'data.attributes.title.required' => 'The title field is required.',
            'data.attributes.description.required' => 'The description field is required.',
            'data.attributes.status.required' => 'The status field is required. and must be A, C, X, H.',
            'data.relationships.author.data.id.required' => 'The author field is required.',
        ];
    }
}
