<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as BaseRequest;

class ServerBrowseRequest extends BaseRequest
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
            'gpu' => 'nullable|string|min:5|max:50|exists:gpus,slug',
            'cpu' => 'nullable|string|min:5|max:50|exists:cpus,slug',
        ];
    }
}
