<?php

namespace Tests\Unit;

use App\Helpers\TimeHelper;
use PHPUnit\Framework\TestCase;

class TimeTest extends TestCase
{
    public function test_datetime_to_timestamp(): void
    {
        $datetime = '2026-02-18 12:30:00';
        $expectedTimestamp = 1771417800;

        $this->assertSame(
            $expectedTimestamp,
            TimeHelper::datetimeToTimestamp($datetime)
        );
    }
}
