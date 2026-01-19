<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Permissions\V1\Abilities;



class UpdateTicketRequest extends BaseTicketRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
      public function rules(): array
    {
        $rules= [
            'data.attributes.title' => 'somtimes|string',
            'data.attributes.description' => 'somtimes|string',
            'data.attributes.status' => 'somtimes:in:A,C,X,H',
            'data.relationships.author.data.id' => 'somtimes|exists:users,id',
  
            //
        ];

        if($this->user()->tokenCan(Abilities::UpdateOwnTicket)){
            $rules['data.relationships.author.data.id'] = 'prohibited';
        }
       
        return $rules;
    }

}
