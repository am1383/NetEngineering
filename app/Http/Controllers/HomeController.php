<?php 
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Interfaces\Services\HomeServiceInterface;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function __construct(
        private readonly HomeServiceInterface $homeService
    ) {}

    public function __invoke(): JsonResponse
    {
        return $this->successResponse($this->homeService
            ->getOverviewCounts()
        );
    }
}
