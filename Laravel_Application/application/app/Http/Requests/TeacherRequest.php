<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'name'=>['required','string','min:2'],
            'email'=>['required','email','unique:users'],
            'password'=>['required','min:4'],
            'first_name'=>['required','string','min:2'],
            'gender'=>['required'],
            'dob'=>['date','required'],
            'joining_date'=>['date','required'],
            'marital_status'=>['string','min:4','nullable'],
            'address'=>['required','min:4'],
            'permanent_address'=>['required','min:4'],
            'qualification'=>['string','nullable'],
            'note'=>['string','nullable'],
            'work_experience'=>['required'],
            'mobile_number'=>['required','numeric'],
            'status'=>['required'],
        ];
    }
}
