<?php 
declare(strict_types=1);

namespace App\Enums;

enum RentType: string
{
    case HOURLY_RENT = 'hourly';

    case DAILY_RENT = 'daily';
}
