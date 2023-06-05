<?php

namespace App\Http\Requests\Pages\AboutUs;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'description' => ['required'],
            'slider_image' => ['nullable','image'],
            'image1' => ['nullable','image'],
            'image2' => ['nullable','image'],
            'special_service' => ['nullable'],
        ];
    }
}
