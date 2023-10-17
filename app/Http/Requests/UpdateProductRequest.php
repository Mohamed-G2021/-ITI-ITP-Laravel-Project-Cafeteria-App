<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        return [
            'name' => Rule::unique('products')->ignore($this->product),
            'price' => 'required|numeric',
            'image' => 'mimes:jpg,bmp,png'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'product name is required',
            'name.unique' => 'product name is already taken',
            'name.min' => 'product name must be at least 3 characters',
            'price.required' => 'product price is required',
            'price.numeric' => 'price must be a number',
            'image' => 'only images are allowed'
        ];
    }
}
