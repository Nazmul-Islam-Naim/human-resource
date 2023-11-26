<?php

namespace App\Http\Requests\EmployeeTransfer;

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
            'workstation_id' => ['required'],
            'designation_id' => ['required'],
            'salary_scale_id' => ['required'],
            'salary' => ['required', 'max:10'],
            'house_rent' => ['nullable', 'max:10'],
            'total_taken_leave' => ['nullable', 'max:10'],
            'allowance' => ['nullable', 'max:10'],
            'transferred_date' => ['required', 'date', 'date_format:Y-m-d'],
            // 'joining_date' => ['required', 'date', 'date_format:Y-m-d'],
            'comment' => ['nullable', 'max:255'],
            'discipline' => ['nullable'],
            'transfer_document' => ['nullable', 'mimes:pdf']
        ];
    }
}
