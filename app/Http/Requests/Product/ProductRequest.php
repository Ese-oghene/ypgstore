<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => 'required|string|max:160',
            'description' => 'required|string',
            'price_ngn' => 'required|integer|min:0',
            'product_image' => 'nullable|image|max:2048', // or binary if using raw upload
            'is_active' => 'boolean'
        ];
    }
}
