<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as BaseRequest;

class ServerRequest extends BaseRequest
{
    private const COMMON_RULES = [
        'cpu_id' => 'required|integer|exists:cpus,id',
        'gpu_id' => 'nullable|integer|exists:gpus,id',
        'ram_id' => 'required|integer|exists:rams,id',
        'storage' => 'required|integer|min:128',
        'os' => 'required|string|max:50',
        'price_per_hour' => 'required|numeric|min:0',
        'price_per_day' => 'required|numeric|min:0',
        'is_active' => 'required|boolean',
    ];

    public function rules(): array
    {
        $methodSpecificRules = match ($this->method()) {
            'POST' => self::COMMON_RULES,

            'PUT', 'PATCH' => [
                'cpu_id' => 'nullable|integer|exists:cpus,id',
                'gpu_id' => 'nullable|integer|exists:gpus,id',
                'ram_id' => 'nullable|integer|exists:rams,id',
                'storage' => 'nullable|integer|min:128',
                'os' => 'nullable|string|max:50',
                'price_per_hour' => 'nullable|numeric|min:0',
                'price_per_day' => 'nullable|numeric|min:0',
                'is_active' => 'nullable|boolean',
            ],
            default => []
        };

        return array_merge(self::COMMON_RULES, $methodSpecificRules);
    }
}
