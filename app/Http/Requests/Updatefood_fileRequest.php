<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Updatefood_fileRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'type' => 'sometimes|string|max:50',
            'description' => 'nullable|string|max:1000',
            'price' => 'sometimes|numeric|min:0',
            'evrg_time' => 'sometimes|integer|min:1',
        ];
    }
    
}
