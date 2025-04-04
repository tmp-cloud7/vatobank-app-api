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
    // public function rules(): array
    // {

    //     return [
    //         'name' => ['nullable', 'string', 'min:2', 'max:200'],
    //         'lastname' => ['nullable', 'string', 'min:2', 'max:200'],
    //         'middlename' => ['nullable', 'string', 'min:2', 'max:200'],
    //         'email' => ['nullable', 'email', 'max:200', 'unique:users'],
    //         'password' => ['nullable', 'string', 'min:8', 'max:200'],
    //         'phone_number' => ['nullable', 'string', 'min:10', 'max:20', 'unique:users'],
    //         'address' => ['nullable', 'string', 'max:200'],
    //         'sog' => ['nullable', 'string', 'max:20'],
    //         'dob' => ['nullable', 'date'], 
    //         'gender' => ['nullable', 'string','in:male,female,other'],
    //        'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2046'],

    //     ];
    // }
//     public function rules()
// {
//     return [
//         'name' => 'nullable|string|max:255',
//         'lastname' => 'nullable|string|max:255',
//         'middlename' => 'nullable|string|max:255',
//         'email' => 'nullable|email|max:255|unique:users,email,'.auth()->id(),
//         'password' => 'nullable|string|min:8|max:200',
//         'phone_number' => 'nullable|string|max:20',
//         'address' => 'nullable|string|max:255',
//        'sog' => 'nullable|string|max:20',
//         'dob' => 'nullable|date',
//         'gender' => 'nullable|in:male,female,other',
//         // 'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
//     ];
    
// }
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
