<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as BaseRequest;

class StoreReservationRequest extends BaseRequest
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
            'server_id' => 'required|integer|exists:servers,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'rent_type' => 'required|string|in:hourly,daily',
        ];
    }
}
