<?php

namespace App\Http\Requests\Pages\Project;

use App\Models\Pages\Project;
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
            'title' => ['required', 'max:255',Rule::unique(Project::class)],
            'slug' => ['required', 'max:255'],
            'details' => ['nullable'],
            'info' => ['nullable'],
            'location' => ['nullable', 'max:255'],
            'project_type_id' => ['required'],
            'cost' => ['nullable', 'max:255'],
            'client' => ['nullable', 'max:255'],
            'progress' => ['nullable', 'max:11'],
            'image' => ['nullable', 'image'],
            'image1' => ['nullable', 'image'],
            'image2' => ['nullable', 'image'],
            'image3' => ['nullable', 'image'],
            'image4' => ['nullable', 'image'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->input('title'))
        ]);
    }
}
