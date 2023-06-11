<?php

namespace App\Http\Requests\PublicationInformation;

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
            'general_information_id' => ['required'],
            'addmore'            =>  ['required', 'array'],
            'addmore.*.publication_id' => ['required'],
            'addmore.*.books_name' => ['required','max:255'],
            'addmore.*.publication_date' => ['required', 'date', 'date_format:Y-m-d'],
            'addmore.*.comment' => ['nullable', 'max:255'],
            'addmore.*.document' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
        ];
    }
}
