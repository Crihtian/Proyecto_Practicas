<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'specialty_code' => 'required|string|size:11',
            'start_date' => 'required|date',
            'finish_date' => 'required|date|after:start_date',
            'active' => 'nullable|boolean',
            'theorical_hours' => 'required|integer|min:0',
            'practice_hours' => 'required|integer|min:0',
        ];
    }
}
