<?php

namespace App\Http\Requests\TrainingInformation;

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
            'addmore.*.course_id' => ['required'],
            'addmore.*.institute_id' => ['required'],
            'addmore.*.date_from' => ['required', 'date', 'date_format:Y-m-d'],
            'addmore.*.date_to' => ['required', 'date', 'date_format:Y-m-d'],
            'addmore.*.comment' => ['nullable', 'max:255'],
            'addmore.*.document' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
        ];
    }
}
