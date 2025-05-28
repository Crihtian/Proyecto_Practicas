<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'name' => 'required|string|max: 100',
            'lastname' => 'required|string|max: 100',
            'idcard' => 'required|string|max:9',
            'email'=> 'required|email|max:255|unique:students,email,'.$this->route('student')?->id,
            'birthday'=> 'nullable|date',
            'disability' => 'nullable|boolean',
            'address' => 'nullable|string|max:255',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->input(('idcard'))) {
                if (!preg_match('/^([0-9]{8}[A-Z]|[A-Z][0-9]{7}[A-Z])$/', $this->input('idcard'))) {
                    $validator->errors()->add('idcard', 'El formato del dni no es correcto.');
                }
            }
        });
    }


}
