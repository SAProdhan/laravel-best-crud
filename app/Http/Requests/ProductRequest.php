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
        return
        [
			'title' => 'required',
			// 'description' => 'required',
			// 'quantity' => 'required|numeric',
			'base_price' => 'required|numeric',
            'variations' => 'nullable|array',
            'variations.quantity.*' => 'numeric'
        ];
    }
}
