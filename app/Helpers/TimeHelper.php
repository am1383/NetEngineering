<?php

namespace App\Helpers;

use Carbon\Carbon;

class TimeHelper
{
    public static function datetimeToTimestamp(string $startTime, string $timezone = 'UTC'): int
    {
        return Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $startTime,
            $timezone
        )->timestamp;
    }
}
