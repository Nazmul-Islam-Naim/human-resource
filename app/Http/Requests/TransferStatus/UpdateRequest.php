<?php

namespace App\Http\Requests\TransferStatus;

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
            'previous_joining_date' => ['required', 'date', 'date_format:Y-m-d'],
        ];
    }
}
