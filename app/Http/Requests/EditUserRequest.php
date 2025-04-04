<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class EditUserRequest extends FormRequest
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
  
public function rules()
{
    return [
        'name' => 'sometimes|string|max:255',
        'lastname' => 'sometimes|string|max:255',
        'middlename' => 'sometimes|string|max:255',
        'email' => 'sometimes|email|max:255|unique:users,email,'.auth()->id(),
        'phone_number' => 'sometimes|string|max:20',
        'address' => 'sometimes|string|max:255',
        'sog' => 'nullable|string|max:20',
        'dob' => 'sometimes|date|nullable',
        'gender' => 'sometimes|in:male,female,other|nullable',
        'password' => 'sometimes|string|min:8|nullable',
        // 'profile_image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048|nullable'
    ];
}
}
