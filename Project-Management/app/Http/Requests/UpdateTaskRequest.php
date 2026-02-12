<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'nullable|array',
            'project_id.*' => 'exists:projects,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
