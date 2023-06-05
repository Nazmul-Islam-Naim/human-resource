<?php

namespace App\Http\Requests\SiteSettings\Logo;

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
            'title' => ['required','max:255'],
            'header_logo' => ['nullable','image'],
            'footer_logo' => ['nullable','image'],
            'fav_icon' => ['nullable','image'],
        ];
    }
}
