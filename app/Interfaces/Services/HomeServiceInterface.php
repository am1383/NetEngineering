<?php 
declare(strict_types=1); 

namespace App\Interfaces\Services;

interface HomeServiceInterface
{
    public function getOverviewCounts(): array;
}
