<?php

namespace App\Http\Requests\Pages\Service;

use App\Models\Pages\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            'title' => ['required', 'max:255', Rule::unique(Service::class)],
            'service_type_id' => ['required'],
            'image1' => ['nullable', 'max:255'],
            'image2' => ['nullable', 'max:255'],
            'details' => ['nullable'],
        ];
    }

    protected function prepareForValidation(){
        $this->merge([
            'slug' => Str::slug($this->input('title'))
        ]);
    }
}
