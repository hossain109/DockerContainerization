<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchParent extends FormRequest
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
            'email'=>['email','nullable'],
            'mobile_number'=>['string','nullable'],
            'occupation'=>['string','nullable'],
            'address'=>['string','nullable']
        ];
    }
}
