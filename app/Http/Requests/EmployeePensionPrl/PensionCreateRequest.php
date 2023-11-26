<?php

namespace App\Http\Requests\EmployeePensionPrl;

use Illuminate\Foundation\Http\FormRequest;

class PensionCreateRequest extends FormRequest
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
            'last_basic_salary' => ['required', 'max:10'],
            'leave_average_pay' => ['required', 'max:10'],
            'leave_half_pay' => ['required', 'max:10'],
            'due_provident_fund' => ['nullable', 'max:10'],
            'leave_encashment_owed' => ['nullable', 'max:10'],
            'amount_gratuity' => ['nullable', 'max:10'],
            'audit_objected_amount' => ['nullable', 'max:10'],
            'reason_audit_objections' => ['nullable', 'max:255'],
            'total_amount_owed' => ['nullable', 'max:10'],
            'amount_money_payable' => ['nullable', 'max:10'],
            'provident_fund' => ['nullable', 'max:10'],
            'leave_encashment' => ['nullable', 'max:10'],
            'gratuity' => ['nullable', 'max:10'],
            'amount_loan_taken' => ['nullable', 'max:10'],
            'reason_amount_loan_taken' => ['nullable', 'max:255'],
            'pension_document' => ['nullable', 'mimes:pdf']
        ];
    }
}
