<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as BaseRequest;

class StoreServerCredentialRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required|string|min:6',
            'password' => 'required|string|min:6',
        ];
    }
}
