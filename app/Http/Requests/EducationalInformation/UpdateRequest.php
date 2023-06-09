<?php

namespace App\Http\Requests\EducationalInformation;

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
            'degree_id' => ['required'],
            'passing_year_id' => ['required'],
            'reading_subject_id' => ['required'],
            'board_id' => ['required'],
            'result' => ['required', 'max:15'],
            'document' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
        ];
    }
}
