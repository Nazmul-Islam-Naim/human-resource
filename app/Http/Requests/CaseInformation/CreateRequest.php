<?php

namespace App\Http\Requests\CaseInformation;

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
            'addmore.*.case_no' => ['required', 'max:100'],
            'addmore.*.punishment' => ['nullable', 'max:255'],
            'addmore.*.punishment_order_date' => ['nullable', 'date', 'date_format:Y-m-d'],
            'addmore.*.release' => ['nullable', 'max:255'],
            'addmore.*.release_order_date' => ['nullable', 'date', 'date_format:Y-m-d'],
            'addmore.*.comment' => ['nullable', 'max:255'],
            'addmore.*.document' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
        ];
    }
}
