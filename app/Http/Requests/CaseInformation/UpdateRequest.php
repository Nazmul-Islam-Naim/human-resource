<?php

namespace App\Http\Requests\CaseInformation;

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
            'case_no' => ['required', 'max:100'],
            'punishment' => ['nullable', 'max:255'],
            'punishment_order_date' => ['nullable', 'date', 'date_format:Y-m-d'],
            'release' => ['nullable', 'max:255'],
            'release_order_date' => ['nullable', 'date', 'date_format:Y-m-d'],
            'comment' => ['nullable', 'max:255'],
            'document' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
        ];
    }
}
