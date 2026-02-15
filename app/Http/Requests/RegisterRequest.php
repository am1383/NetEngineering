<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as BaseRequest;

class RegisterRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'phone_number' => 'required|string|regex:/^09\d{9}$/|unique:users,phone_number',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ];
    }
}
