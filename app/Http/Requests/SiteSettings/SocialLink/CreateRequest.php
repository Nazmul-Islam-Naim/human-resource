<?php

namespace App\Http\Requests\SiteSettings\SocialLink;

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
            'facebook' => [ 'required', 'max:255', 'url' ],
            'twitter' => [ 'nullable', 'max:255', 'url' ],
            'linkedin' => [ 'nullable', 'max:255', 'url' ],
            'whatsapp' => [ 'nullable', 'max:255', 'url' ],
        ];
    }
}
