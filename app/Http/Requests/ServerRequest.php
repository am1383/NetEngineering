<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as BaseRequest;

class ServerRequest extends BaseRequest
{
    private const COMMON_RULES = [
        'cpu' => 'required|string|max:50',
        'gpu' => 'nullable|string|max:50',
        'ram' => 'required|integer',
        'storage' => 'required|integer',
        'os' => 'required|string|max:50',
        'price_per_hour' => 'required|numeric|min:0',
        'price_per_day' => 'required|numberic|min:0',
        'is_active' => 'required|boolean',
    ];

    public function rules(): array
    {
        $methodSpecificRules = match ($this->method()) {
            'POST' => [
            ],
            'PUT' => [
                'cpu' => 'nullable|string|max:50',
                'gpu' => 'nullable|string|max:50',
                'ram' => 'nullable|integer',
                'storage' => 'nullable|integer',
                'os' => 'nullable|string|max:50',
                'price_per_hour' => 'nullable|numeric|min:0',
                'price_per_day' => 'nullable|numberic|min:0',
                'is_active' => 'required|boolean',
            ],
            default => []
        };

        return array_merge(self::COMMON_RULES, $methodSpecificRules);
    }
}
