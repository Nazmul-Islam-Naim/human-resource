<?php

namespace App\Http\Requests\Pages\BlogCategory;

use App\Models\Pages\BlogCategory;
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
            'title' => ['required', 'max:255', Rule::unique(BlogCategory::class)]
        ];
    }

    protected function prepareForValidation(){
        $this->merge([
            'slug' => Str::slug($this->input('title'))
        ]);
    }
}
