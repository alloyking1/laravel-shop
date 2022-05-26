<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:225|unique:categories',
            'description' => 'required|string|max:225',
            'image' => 'nullable|file|image|mimes:mimes:jpg,png,jpeg,gif,svg|max:2048'
        ];
    }
}
