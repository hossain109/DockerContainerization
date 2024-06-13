<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'admission_number'=>['required'],
            'roll_number'=>['required'],
            'class'=>['required'],
            'gender'=>['required'],
            'dob'=>['required'],
            'mobile_number'=>['required','numeric'],
            'admission_date'=>['required'],
            'profile_pic'=>['required'],
            'blood_group'=>['required'],
            'height'=>['required'],
            'weight'=>['required'],
            'status'=>['required'],
        ];
    }
}
