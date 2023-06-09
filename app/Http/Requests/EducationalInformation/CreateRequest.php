<?php

namespace App\Http\Requests\EducationalInformation;

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
            'addmore.*.degree_id' => ['required'],
            'addmore.*.passing_year_id' => ['required'],
            'addmore.*.reading_subject_id' => ['required'],
            'addmore.*.board_id' => ['required'],
            'addmore.*.result' => ['required', 'max:15'],
            'addmore.*.document' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
        ];
    }
}
