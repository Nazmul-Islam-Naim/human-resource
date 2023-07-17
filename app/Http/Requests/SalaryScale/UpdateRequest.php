<?php

namespace App\Http\Requests\SalaryScale;

use App\Models\SalaryScale;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['required','max:50', Rule::unique(SalaryScale::class)->ignore($this->salary_scale)],
            'salary' => ['required','max:50']
        ];
    }
}
