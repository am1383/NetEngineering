<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as BaseRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends BaseRequest
{
    private const COMMON_RULES = [
        'name' => 'required|string|min:3|max:30',
        'phone_number' => 'required|string|regex:/^09\d{9}$/|unique:users,phone_number',
        'email' => 'nullable|email|unique:users,email',
    ];

    public function rules(): array
    {
        $methodSpecificRules = match ($this->method()) {
            'POST' => [
                'password' => ['required', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
                ],
            ],
            'PUT', 'PATCH' => [
                'password' => ['nullable', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
                ],
                'name' => 'nullable|string|min:3|max:30',
                'phone_number' => 'nullable|string|regex:/^09\d{9}$/|unique:users,phone_number',
                'email' => 'nullable|email|unique:users,email',
            ],

            default => []
        };

        return array_merge(self::COMMON_RULES, $methodSpecificRules);
    }
}
