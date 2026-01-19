<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class BaseTicketRequest extends FormRequest
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
  public function MappedAttributes(): array
    {
        $dataMapper= [
        'data.attributes.title'=>    'title',
        'data.attributes.description'=>    'description',
        'data.attributes.status'=>    'status',
        'data.attributes.created_at'=>    'created_at',
        'data.attributes.updated_at'=>    'updated_at',
        'data.relationships.author.data.id'=>    'user_id',
        ];
        $attrupdate=[];
        foreach($dataMapper as $key=>$value){
          if($this->has($key)){
            $attrupdate[$value]=$this->input($key);
          }
        }
        return $attrupdate;
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
