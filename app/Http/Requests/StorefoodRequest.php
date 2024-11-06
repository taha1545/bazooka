<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorefoodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:50', 
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0', 
           'evrg_time' => 'required|integer|min:1', 
        ];
    }
}
