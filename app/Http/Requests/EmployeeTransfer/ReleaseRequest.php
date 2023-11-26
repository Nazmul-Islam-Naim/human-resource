<?php

namespace App\Http\Requests\EmployeeTransfer;

use Illuminate\Foundation\Http\FormRequest;

class ReleaseRequest extends FormRequest
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
            'release_date' => ['nullable', 'date', 'date_format:Y-m-d'],
            'joining_date' => ['nullable', 'date', 'date_format:Y-m-d'],
            'release_document' => ['nullable', 'mimes:pdf'],
            'join_document' => ['nullable', 'mimes:pdf'],
        ];
    }
}
