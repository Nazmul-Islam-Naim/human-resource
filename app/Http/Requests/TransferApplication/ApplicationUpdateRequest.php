<?php

namespace App\Http\Requests\TransferApplication;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationUpdateRequest extends FormRequest
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
            'transfer_number' => ['required'],
            'first_paragraph' => ['required'],
            'editordata1' => ['required'],
            'editordata2' => ['required'],
        ];
    }
}
