<?php

namespace App\Helpers;

use Carbon\Carbon;

class TimeHelper
{
    public static function datetimeToTimestamp(string $startTime): int
    {
        return Carbon::parse($startTime)
            ->timestamp;
    }
}
