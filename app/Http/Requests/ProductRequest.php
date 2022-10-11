<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    { 
        return [
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:'.$this->price+1,
            'images' => 'array|min:1', 
            'images.*.path' => 'required', 
        ];
    }
    public function messages()
    {
        return [
            'cost.min'=> 'Cost must be greater than Price!'
        ];
    }
    
}
