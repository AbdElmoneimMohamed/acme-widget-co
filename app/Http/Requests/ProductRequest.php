<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // You can implement authorization logic here if needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'product_code' => 'required|string|exists:products,code',
        ];
    }

    /**
     * Custom messages for validation errors.
     * @return array<string>
     */
    public function messages(): array
    {
        return [
            'product_code.required' => 'The product code is required.',
            'product_code.exists' => 'The product code is not valid.',
        ];
    }
}
