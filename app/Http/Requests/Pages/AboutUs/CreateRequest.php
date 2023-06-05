<?php

namespace App\Http\Requests\Pages\AboutUs;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'slider_image' => ['required','image'],
            'image1' => ['required','image'],
            'image2' => ['required','image'],
            'special_service' => ['nullable'],
        ];
    }
}
