<?php

namespace App\Http\Requests\Pages\Team;

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
            'name' => ['required', 'max:255'],
            'phone' => ['nullable', 'max:15'],
            'email' => ['nullable', 'max:50'],
            'image' => ['nullable', 'image'],
            'designation_id' => ['required'],
        ];
    }
}
