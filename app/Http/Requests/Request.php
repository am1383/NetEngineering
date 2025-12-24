<?php

namespace App\Http\Requests;

use App\Response\ValidationResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class Request extends FormRequest
{
    abstract public function rules(): array;

    protected function failedValidation(Validator $validator): void
    {
        $response = new ValidationResponse($validator->errors());

        throw new HttpResponseException(
            $response->toResponse($this->request)
        );
    }

    protected function prepareForValidation() {}
}
