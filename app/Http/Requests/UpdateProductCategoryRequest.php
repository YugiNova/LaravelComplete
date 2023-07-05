<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|string|unique:product_category,name,'.$this->id,
                //'slug' => 'required|min:3|string',
                'status' => 'required|boolean',
        ];
    }

    public function messages():array
    {
        return[
            'name.required' => 'Name is required',
                'name.min' => 'Name have to least 3 character',
                'slug.required' => 'Slug is required',
                //'slug.min' => 'Slug have to least 3 character', 
                'status.required' => 'Status is required',
                'status.boolean' => 'Status is required',
        ];
    }
}
