<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchStudent extends FormRequest
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
            'class_name'=>['string','nullable'],
            'name'=>['string','nullable'],
            'email'=>['email','nullable'],
            'date'=>['date','nullable'],
            'roll_number'=>['string','nullable'],
            'admission_number'=>['string','nullable']
        ];
    }
}
