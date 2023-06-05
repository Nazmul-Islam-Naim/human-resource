<?php

namespace App\Http\Requests\SiteSettings\Contact;

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
            'email' => ['required', 'max:255', 'email'],
            'phone' => ['required', 'max:20'],
            'address' => ['required', 'max:255'],
            'office_time' => ['required', 'max:255'],
            'lat' => ['nullable', 'max:255'],
            'long' => ['nullable', 'max:255'],
        ];
    }
}
