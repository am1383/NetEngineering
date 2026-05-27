<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\Exception\AccessDeniedException;

Route::middleware(['throttle:60,1'])->group(function () {
    Route::get('/docs', function () {
        if (app()->environment('local', 'staging')) {
            return view('scribe.index');
        }

        throw new AccessDeniedException();
    });
});