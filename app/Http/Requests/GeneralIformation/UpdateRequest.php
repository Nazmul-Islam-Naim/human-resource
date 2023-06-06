<?php

namespace App\Http\Requests\GeneralIformation;

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
            'psc_merit_serial' => ['nullable', 'max:50'],
            'name_in_bangla' => ['required', 'max:100'],
            'name_in_english' => ['nullable', 'max:100'],
            'district_id' => ['required'],
            'birth_date' => ['nullable'],
            'posting' => ['nullable'],
            'location' => ['nullable'],
            'sex' => ['required'],
            'maritial_status' => ['required'],
            'nid' => ['nullable', 'max:20'],
            'fathers_name_in_bangla' => ['required', 'max:100'],
            'fathers_name_in_english' => ['nullable', 'max:100'],
            'mothers_name_in_bangla' => ['required', 'max:100'],
            'mothers_name_in_english' => ['nullable', 'max:100'],
            'joining_date' => ['nullable'],
            'go_date' => ['nullable'],
            'religion' => ['required'],
            'freedom_fighter' => ['required'],
            'freedom_fighter_child' => ['required'],
            'photo' => ['nullable','image'],
            'signature' => ['nullable','image']
        ];
    }
}
