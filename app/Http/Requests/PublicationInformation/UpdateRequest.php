<?php

namespace App\Http\Requests\PublicationInformation;

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
            'publication_id' => ['required'],
            'books_name' => ['required','max:255'],
            'publication_date' => ['required', 'date', 'date_format:Y-m-d'],
            'comment' => ['nullable', 'max:255'],
            'document' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
        ];
    }
}
