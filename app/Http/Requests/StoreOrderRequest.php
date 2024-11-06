<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'id_customer' => 'required|exists:customers,id',
            'id_driver' => 'nullable|exists:drivers,id', 
            'is_cook' => 'required|boolean', 
            'is_finish' => 'required|boolean', 
            'location_lat' => 'required|string|regex:/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?)/', 
            'location_long' => 'required|string|regex:/^[-+]?((1[0-7]\d)|(\d{1,2}))(\.\d+)?$/', 
        ];
    }
}
