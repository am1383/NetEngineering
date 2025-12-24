<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Interfaces\Services\LoginServiceInterface;

class LoginController
{
    public function __construct(private LoginServiceInterface $authService) {}

    public function login(LoginRequest $request) {}
}
