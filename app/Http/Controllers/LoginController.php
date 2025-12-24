<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Interfaces\Services\LoginServiceInterface;

class LoginController
{
    public function __construct(private LoginServiceInterface $loginService) {}

    public function login(LoginRequest $request) 
    {
        return $this->loginService->login(
            $request->phone_number,
            $request->password
        );
    }
}
