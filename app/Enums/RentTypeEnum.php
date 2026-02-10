<?php

namespace App\Enums;

enum RentTypeEnum: string
{
    case HOURLY_RENT = 'hourly';

    case DAILY_RENT = 'daily';
}
