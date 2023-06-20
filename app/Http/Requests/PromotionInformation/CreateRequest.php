<?php

namespace App\Http\Requests\PromotionInformation;

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
            'designation_id' => ['required'],
            'promotion_date' => ['required', 'date', 'date_format:Y-m-d'],
            'order_no' => ['required', 'max:255'],
            'date' => ['required', 'date', 'date_format:Y-m-d'],
            'salary_scale_id' => ['required'],
            'salary' => ['nullable', 'max:10']
        ];
    }
}
