<?php

namespace App\Http\Requests\GeneralIformation;

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
            'employee_id' => ['nullable', 'max:50'],
            'name_in_bangla' => ['required', 'max:100'],
            'name_in_english' => ['nullable', 'max:100'],
            'fathers_name_in_bangla' => ['required', 'max:100'],
            'mothers_name_in_bangla' => ['required', 'max:100'],
            'district_id' => ['required'],
            'birth_date' => ['nullable', 'date'],
            'prl_date' => ['nullable', 'date'],
            'present_designation_id' => ['required'],
            'present_workstation_id' => ['required'],
            'salary_scale_id' => ['required'],
            'joining_date' => ['nullable', 'date'],
            'joining_designation_id' => ['nullable'],
            'permanent_date' => ['nullable'],
            'order_no' => ['nullable'],
            'permanent_address' => ['nullable'],
            'present_address' => ['nullable'],
            'mobile' => ['nullable', 'max:15'],
            'email' => ['nullable', 'max:30'],
            'sex' => ['required'],
            'maritial_status' => ['required'],
            'spouse_name_in_bangla' => ['nullable', 'max:100'],
            'occupation_id' => ['nullable'],
            'spouse_district_id' => ['nullable'],
            'photo' => ['nullable','image'],
            'signature' => ['nullable','image']
        ];
    }
}
