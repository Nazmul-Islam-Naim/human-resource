<?php

namespace App\Http\Requests\SiteSettings\Slider;

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
            'message1' => ['required', 'max:150'],
            'title1' => ['required', 'max:150'],
            'link1' => ['nullable', 'max:255'],
            'image1' => ['required', 'image'],
            'message2' => ['required', 'max:150'],
            'title2' => ['required', 'max:150'],
            'link2' => ['nullable', 'max:255'],
            'image2' => ['required', 'image'],
            'message3' => ['required', 'max:150'],
            'title3' => ['required', 'max:150'],
            'link3' => ['nullable', 'max:255'],
            'image3' => ['required', 'image'],
        ];
    }
}
