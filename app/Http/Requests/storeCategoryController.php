<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeCategoryController extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:3|unique:categories',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Logo is now required
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The :attribute field is required.',
            'name.max' => 'The :attribute may not be greater than :max characters.',
            'name.min' => 'The :attribute must be at least :min characters.',
            'logo.required' => 'The logo is required. Please upload an image.',
        ];
    }
    
}
