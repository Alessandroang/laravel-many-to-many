<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'name' => 'nullable|string',
            'title' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'content' => 'nullable|string',
            'slug' => 'nullable|string',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => ['nullable', 'exists:technologies,id'],
        ];
    }
}
