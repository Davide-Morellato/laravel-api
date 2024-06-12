<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_project' => 'required|max:150|string',
            'slug' => ['required', 'max:255', Rule::unique('projects', 'slug')->ignore($this->project->id)],
            'url_github' => 'required|string',
            'description' => 'nullable|string',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id'
        ];
    }
}
