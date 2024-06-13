<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchTeacher extends FormRequest
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
            'name'=>['string','nullable'],
            'email'=>['string','email','nullable'],
            'mobile_number'=>['numeric','nullable'],
            'joining_date'=>['date','nullable'],
        ];
    }
}
