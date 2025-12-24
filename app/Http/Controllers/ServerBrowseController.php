<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\ServerServiceInterface;
use Illuminate\Http\Request;

class ServerBrowseController
{
    public function __construct(private ServerServiceInterface $serverService) {}

    public function index(Request $request)
    {
        return $this->serverService
            ->getAvailableServers($request->get('gpu'), $request->get('cpu'));
    }
}
