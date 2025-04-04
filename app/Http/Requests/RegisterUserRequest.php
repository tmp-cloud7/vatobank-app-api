<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            'name' => ['required', 'string', 'min:2', 'max:200'],
            'lastname' => ['required', 'string', 'min:2', 'max:200'],
            'middlename' => ['nullable', 'string', 'min:2', 'max:200'],
            'email' => ['required', 'email', 'max:200', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:200'],
            'phone_number' => ['required', 'string', 'min:10', 'max:20', 'unique:users'],
            'address' => ['nullable', 'string', 'max:200'],
            'sog' => ['nullable', 'string', 'max:20'],
            'dob' => ['nullable', 'date'], 
            'gender' => ['nullable', 'string','in:male,female,other'],
           'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2046'],

        ];
    }
}
